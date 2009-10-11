<?php

/**
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation; either
 * version 2.1 of the License, or (at your option) any later version.
 *
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public
 * License along with this library; if not, write to the Free Software
 * Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
 *
 * For questions, help, comments, discussion, etc., please send
 * e-mail to tan-tan@simple.co.il
 */

require_once dirname(__FILE__) . '/../core/sockets/Ezer_SocketServer.php';
require_once 'Ezer_BusinessProcessClient.php';


/**
 * Purpose:     Store a single task, refers to a case and step
 * @author Tan-Tan
 * @package Engine
 * @subpackage Process
 */
class Ezer_BusinessProcessServerTask
{
	public $process_instance_index;
	public $step_index;
	
	public function __construct($process_instance_index, $step_index)
	{
		$this->process_instance_index = $process_instance_index;
		$this->step_index = $step_index;
	}
	
	public function __toString()
	{
		return "$this->process_instance_index, $this->step_index";
	}
}

/**
 * Purpose:     Store a single task, refers to a activity object
 * @author Tan-Tan
 * @package Engine
 * @subpackage Process
 */
class Ezer_BusinessProcessWorkerTask extends Ezer_BusinessProcessServerTask
{
	private $work_object;
	private $require_path = null;
	
	public function __construct(Ezer_BusinessProcessServerTask $task, Ezer_AsynchronousActivity $activity)
	{
		parent::__construct($task->process_instance_index, $task->step_index);
		
		$this->work_object = base64_encode(serialize($activity));
		$reflector = new ReflectionClass($activity);
		$this->require_path = $reflector->getFileName();
	}
	
	public function execute(Ezer_BusinessProcessHandler $process_worker)
	{
		if($this->require_path)
			require_once $this->require_path;
			
		$activity = unserialize(base64_decode($this->work_object));
		$activity->executeOnWorker($process_worker);
	}
}

/**
 * Purpose:     Run the BPM server
 * @author Tan-Tan
 * @package Engine
 * @subpackage Process
 */
class Ezer_BusinessProcessServer extends Ezer_SocketServer
{
	private $logic_persistance;
	private $logic_processes;
	
	private $case_persistances = array();
	private $process_instances = array();
	
	public function __construct(Ezer_ProcessLogicPersistance $logic_persistance)
	{			
		parent::__construct(2);
		
		$this->logic_persistance = $logic_persistance;
		$this->loadLogics();
	}
	
	public function addCasePersistance(Ezer_ProcessCasePersistance $case_persistance)
	{
		$this->case_persistances[] = $case_persistance;
	}
	
	protected function loadLogics()
	{
		$this->logic_processes = $this->logic_persistance->getProcesses();
	}

	protected function handleTask(Ezer_BusinessProcessServerTask $task)
	{
//		echo "handleTask($task)\n";
		$process_instance = &$this->process_instances[$task->process_instance_index];
		$step_instance = &$process_instance->step_instances[$task->step_index];
		
		if($step_instance->shouldRunOnServer())
			return $this->handleSynchronousStep($task, $step_instance);
				
		return $this->handleAsynchronousStep($task, $step_instance);
	}
	
	public function handleAsynchronousStep(Ezer_BusinessProcessServerTask $task, Ezer_StepInstance $step_instance)
	{
		$worker_object = $step_instance->getWorkerAndStart();
		$worker_task = new Ezer_BusinessProcessWorkerTask($task, $worker_object);
		return parent::handleTask($worker_task);
	}
	
	public function handleSynchronousStep(Ezer_BusinessProcessServerTask $task, Ezer_StepInstance $step_instance)
	{
		$step_instance->start();
		if($step_instance->isDone())
			$this->taskDone($task);
			
		return true;
	}
	
	public function taskProgressed($task, $percent)
	{
		$process_instance = &$this->process_instances[$task->process_instance_index];
		$step_instance = &$process_instance->step_instances[$task->step_index];
		$step_instance->setProgress($percent);
	}
	
	public function taskFailed($task, $err)
	{
		$step_instance->failed($err);
		$name = $step_instance->getName();
		echo "Step $name failed: $err\n";
	}
	
	public function taskDone($task)
	{
//		echo "taskDone(task)\n";
		
		$process_instance = &$this->process_instances[$task->process_instance_index];
		$step_instance = &$process_instance->step_instances[$task->step_index];
		if(!$step_instance->isDone())
			$step_instance->done();
		
		$this->updateTasks();
	}
	
	protected function updateTasks()
	{
		foreach($this->case_persistances as $case_persistance)
		{
			$cases = $case_persistance->getCases();
			if(!count($cases))
				continue;
				
			foreach($cases as $case)
			{
				if(!isset($this->logic_processes[$case->process_identifier]))
					throw new Ezer_ProcessLogicNotFound($case->process_identifier);
				
				$process = $this->logic_processes[$case->process_identifier];
				$process_instance = &$process->createBusinessProcessInstance($case->variables);
				$this->process_instances[] = &$process_instance;
			}
		}
		
		$steps_added = false;
		foreach($this->process_instances as $process_instance_index => $process_instance)
		{
			$steps_added_this_process = false;
			foreach($process_instance->step_instances as $step_index => $step)
			{
//				echo get_class($step) . "(" . $step->getName() . ") status: " . $step->getStatus() . "\n";
				if(!$step->isAvailable())
					continue;
					
				$steps_added = true;
				$steps_added_this_process = true;
				
				$task = new Ezer_BusinessProcessServerTask($process_instance_index, $step_index);
				$priority = time() * $step->priority;
				$this->tasks[$priority] = $task;
			}
			
			if(!$steps_added_this_process && $process_instance->isDone())
			{
				echo "PROCESS IS DONE!!!\n";
				unset($this->process_instances[$process_instance_index]);
			}
		}
		
		if($steps_added)
		{
//			echo "New Task Is Available!\n";
			krsort($this->tasks);
		}
	}
	
	protected function kick()
	{
		$this->writeToAll('kicked');
	}
	
	protected function isAlive()
	{
		return true;
	}
	
	public function addThreadClient(Ezer_BusinessProcessClient $client)
	{
		$pid = $client->getPid();
		$this->writeToAll("add thread: $pid");
		parent::addThreadClient($client);
	}
	
	protected function getNewSocketClient($client_sock)
	{
		$this->writeToAll("new socket connected");
		return new Ezer_SocketClient($client_sock);
	}
	
	public function writeToAll($text)
	{
		echo "$text\n";
		parent::writeToAll("$text\r\n");
	}
}

?>