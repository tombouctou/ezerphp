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
 * Purpose:     Store a sindle task, refers to a case and step
 * @author Tan-Tan
 * @package Engine
 * @subpackage Process
 */
class Ezer_BusinessProcessTask
{
	public $process_instance_index;
	public $step_index;
	
	public function __construct($process_instance_index, $step_index)
	{
		$this->process_instance_index = $process_instance_index;
		$this->step_index = $step_index;
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

	protected function handleTask(Ezer_BusinessProcessTask $task)
	{
		$process_instance = &$this->process_instances[$task->process_instance_index];
		$step_instance = &$process_instance->steps[$task->step_index];
		
		if($step_instance->shouldRunOnServer())
		{
			$step_instance->start();
			if($step_instance->isDone())
				$this->taskDone($task);
				
			return true;
		}
		
		return parent::handleTask($task);
	}
	
	public function taskDone($task)
	{
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
				$process_instance = $process->createInstance($case->variables);
				$this->process_instances[] = &$process_instance;
			}
		}
		
		$steps_added = false;
		foreach($this->process_instances as $process_instance_index => $process_instance)
		{
			foreach($process_instance->steps as $step_index => $step)
			{
//				echo "step: " . get_class($step) . " status: " . $step->getStatus() . "\n";
				if(!$step->isAvailable())
					continue;
					
				$steps_added = true;
				
				$task = new Ezer_BusinessProcessTask($process_instance_index, $step_index);
				$priority = time() * $step->priority;
				$this->tasks[$priority] = $task;
			}
		}
		
		if($steps_added)
			krsort($this->tasks);
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