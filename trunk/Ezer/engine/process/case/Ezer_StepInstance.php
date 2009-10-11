<?php

/**
 * Project:     PHP Ezer business process manager
 * File:        Ezer_StepInstance.php
 * Purpose:     Stores a single instance for the execution of a step for a specified case
 * 
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
 *
 * @author Tan-Tan
 * @package Engine
 * @subpackage Process.Case
 */
class Ezer_StepInstanceStatus
{
	const LOADED = 1;
	const AVAILABLE = 2;
	const STARTED = 3;
	const DONE = 4;
	const FAILED = 5;
}

/**
 * @author Tan-Tan
 * @package Engine
 * @subpackage Process.Case
 */
abstract class Ezer_StepInstance
{
	public $debug = 0;
	protected $process_instance;
	protected $step;
	protected $status;
	protected $max_retries;
	protected $attempts;
	protected $flowed_in = array();
	
	public abstract function shouldRunOnServer();
	
	public function __construct(Ezer_BusinessProcessInstance &$process_instance, Ezer_Step $step)
	{
		$this->status = Ezer_StepInstanceStatus::LOADED;
		$this->max_retries = $step->getMaxRetries();
		$this->attempts = 0;
		$this->step = $step;
		$this->process_instance = &$process_instance;
		$this->process_instance->steps[] = &$this;
	}
	
	public function getStatus()
	{
		return $this->status;
	}
	
	public function getStepId()
	{
		return $this->step->id;
	}
	
	public function flow($step_id = null)
	{
		if(is_null($step_id) && !count($this->step->in_flows))
		{
			$this->status = Ezer_StepInstanceStatus::AVAILABLE;
			return true;
		}

		if(!isset($this->step->in_flows[$step_id]))
			return false;
			
		$this->flowed_in[$step_id] = true;
		if($this->status != Ezer_StepInstanceStatus::LOADED)
			return true;
			
		if($this->step->getJoinPolicy() == Ezer_StepJoinPolicy::JOIN_OR || count($this->flowed_in) >= count($this->step->in_flows))
		{
			$this->status = Ezer_StepInstanceStatus::AVAILABLE;
			return true;
		}
		
		return false;
	}
	
	protected function retry()
	{
		if($this->attempts >= $this->max_retries)
			$this->status = Ezer_StepInstanceStatus::FAILED;
		else
			$this->status = Ezer_StepInstanceStatus::AVAILABLE;
	}
	
	public function isAvailable()
	{
		return ($this->status == Ezer_StepInstanceStatus::AVAILABLE);
	}
	
	public function isStarted()
	{
		return ($this->status == Ezer_StepInstanceStatus::STARTED);
	}
	
	public function isDone()
	{
		return ($this->status == Ezer_StepInstanceStatus::DONE);
	}
	
	public function start()
	{
//		echo get_class($this) . " is started\n";
//		if(get_class($this) == 'Ezer_SequenceInstance')
//		{
//			$trace = debug_backtrace(false);
//			foreach($trace as $tr)
//				echo $tr['file'] . ': ' . $tr['line'] . ': ' . $tr['function'] . "\n";
//		}
			
		$this->status = Ezer_StepInstanceStatus::STARTED;
		$this->attempts++;
	}
	
	public function done()
	{
//		echo get_class($this) . " is done\n";
		$this->status = Ezer_StepInstanceStatus::DONE;
	}
}