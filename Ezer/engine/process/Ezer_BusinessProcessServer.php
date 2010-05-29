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
		
//		echo "handle (" . get_class($step_instance) . ", " . $step_instance->getName() . ")\n";
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
	
	public function asyncTaskStarted($task)
	{
		$process_instance = &$this->process_instances[$task->process_instance_index];
		$step_instance = &$process_instance->step_instances[$task->step_index];
		$step_instance->handled();
	}

	/**
	 * Sets a variable value in the scope instance, on the server.
	 * @param $variable_path string separated by / to the variable and part that should be set
	 * @param $value the new value
	 */
	public function setVariable($task, $variable_path, $value)
	{
		$process_instance = &$this->process_instances[$task->process_instance_index];
		$step_instance = &$process_instance->step_instances[$task->step_index];
		$step_instance->setVariable($variable_path, $value);
	}
	
	public function taskFailed($task, $err)
	{
		$process_instance = &$this->process_instances[$task->process_instance_index];
		$step_instance = &$process_instance->step_instances[$task->step_index];
		$step_instance->failed($err);
		echo "Step " . $step_instance->getName() . " failed: $err\n";
	}
	
	public function taskDone($task)
	{
//		echo "taskDone(task)\n";
		
		$process_instance = &$this->process_instances[$task->process_instance_index];
		$step_instance = &$process_instance->step_instances[$task->step_index];
		if(!$step_instance->isDone())
			$step_instance->done();
		
//		$this->updateTasks();
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
				$process_identifier = $case->getProcessIdentifier();
				if(!isset($this->logic_processes[$process_identifier]))
					throw new Ezer_ProcessLogicNotFound($process_identifier);
				
				$process = $this->logic_processes[$process_identifier];
				$process_instance = &$process->createBusinessProcessInstance($case->getVariables());
				$this->process_instances[uniqid('case_')] = $process_instance;
			}
		}
		
		$step_instances_added = false;
		foreach($this->process_instances as $process_instance_index => $process_instance)
		{
			$step_instances_added_this_process = false;
			foreach($process_instance->step_instances as $step_instance_index => $step_instance)
			{
				if(!$step_instance->isAvailable())
					continue;
					
				$step_instance->queued();
				
				$step_instances_added = true;
				$step_instances_added_this_process = true;
				
				$task = new Ezer_BusinessProcessServerTask($process_instance_index, $step_instance_index);
				$priority = 'p_' . (microtime() * $step_instance->getPriority());
				usleep(1);
				$this->tasks[$priority] = $task;
			}
			
			if(!$step_instances_added_this_process && $process_instance->isDone())
			{
				echo "PROCESS IS DONE!!!\n";
				unset($this->process_instances[$process_instance_index]);
			}
		}
		
		if($step_instances_added)
		{
//			echo "New Task Is Available!\n";
			krsort($this->tasks);
		}
//		var_dump(count($this->tasks));
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

