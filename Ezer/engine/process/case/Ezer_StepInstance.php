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
 * Purpose:     Enum with all possible step statuses
 * @author Tan-Tan
 * @package Engine
 * @subpackage Process.Case
 */
class Ezer_StepInstanceStatus
{
	const LOADED = 1;
	const AVAILABLE = 2;
	const QUEUED = 3;
	const STARTED = 4;
	const HANDLED = 5;
	const DONE = 6;
	const FAILED = 7;
}

/**
 * Purpose:     Stores a single instance for the execution of a step for a specified case
 * @author Tan-Tan
 * @package Engine
 * @subpackage Process.Case
 */
abstract class Ezer_StepInstance implements Ezer_IntStepInstance
{
	/**
	 * @var int
	 */
	protected $progress = 0;
	
	/**
	 * @var Ezer_StepContainerInstance
	 */
	protected $scope_instance;
	
	/**
	 * @var Ezer_Step
	 */
	protected $step;
	
	/**
	 * @var int
	 */
	protected $max_retries;
	
	/**
	 * @var int
	 */
	protected $attempts;
	
	/**
	 * @var array
	 */
	protected $flowed_in = array();
	
	/**
	 * @var Ezer_StepInstanceStatus
	 */
	protected $status;
	
	public abstract function shouldRunOnServer();

	public function getWorkerAndStart()
	{
		return null;
	}
	
	public function __construct($id, Ezer_StepContainerInstance &$scope_instance, Ezer_Step $step)
	{
		$this->id = $id;
		$this->max_retries = $step->getMaxRetries();
		$this->attempts = 0;
		$this->step = $step;
		$this->scope_instance = &$scope_instance;
		
		if($this !== $scope_instance)
			$this->scope_instance->step_instances[] = &$this;
			
		$this->setStatus(Ezer_StepInstanceStatus::LOADED);
	}	
	
	/**
	 * @return int
	 */
	public function getId()
	{
		return $this->id;
	}
	
	public function queued()
	{
		$this->setStatus(Ezer_StepInstanceStatus::QUEUED);
	}
	
	public function setStatus($status)
	{
//		if(get_class($this) == 'Ezer_ActivityStepInstance')
//		{
//			$trace = debug_backtrace(false);
//			foreach($trace as $tr)
//				echo $tr['file'] . ': ' . $tr['line'] . ': ' . $tr['function'] . "\n";
//		}
//		echo "setStatus (" . get_class($this) . ", " . $this->getName() . ", $status)\n";
		$this->status = $status;
		$this->persist();
	}
	
	public function getStatus()
	{
		return $this->status;
	}
	
	public function getStepId()
	{
		return $this->step->getId();
	}
	
	/**
	 * @param string $step_id
	 */
	public function flow($step_id = null)
	{
		if(is_null($step_id) && !$this->step->getInFlowsCount())
		{
			$this->setStatus(Ezer_StepInstanceStatus::AVAILABLE);
			return true;
		}

		if(!$this->step->hasInFlow($step_id))
		{
			return false;
		}
			
		$this->flowed_in[$step_id] = true;
		if($this->status != Ezer_StepInstanceStatus::LOADED)
		{
			return true;
		}
			
		if($this->step->getJoinPolicy() == Ezer_StepJoinPolicy::JOIN_OR || count($this->flowed_in) >= $this->step->getInFlowsCount())
		{
//			echo get_class($this) . "(" . $this->getName() . ") is available\n";
			$this->setStatus(Ezer_StepInstanceStatus::AVAILABLE);
			return true;
		}
		
		return false;
	}
	
	protected function retry()
	{
		if($this->attempts >= $this->max_retries)
			$this->setStatus(Ezer_StepInstanceStatus::FAILED);
		else
			$this->setStatus(Ezer_StepInstanceStatus::AVAILABLE);
	}
	
	public function getProgress()
	{
		return $this->progress;
	}
	
	public function setProgress($percent)
	{
//		echo "Ezer_StepInstance::setProgress($percent%)\n";
		$this->progress = $percent;
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
		$this->started();
	}
	
	public function started()
	{
		$this->setStatus(Ezer_StepInstanceStatus::STARTED);
		$this->attempts++;
	}
	
	public function handled()
	{
		$this->setStatus(Ezer_StepInstanceStatus::HANDLED);
	}
	
	public function getName()
	{
		return $this->step->getName();
	}
	
	public function getOutFlows()
	{
		return $this->step->getOutFlows();
	}
	
	public function getPriority()
	{
		return min(1, max(10, $this->step->getPriority())); 
	}
	
	public function failed($err)
	{
//		echo get_class($this) . " failed($err)\n";
		$this->setStatus(Ezer_StepInstanceStatus::FAILED);
	}
	
	public function done()
	{
		$this->setStatus(Ezer_StepInstanceStatus::DONE);
	}
	
	/**
	 * Sets a variable value in the scope instance, on the server.
	 * @param $variable_path string separated by / to the variable and part that should be set
	 * @param $value the new value
	 */
	public function setVariable($variable_path, $value)
	{
		$this->scope_instance->setVariableByPath($variable_path, $value);
	}
	
	public function persist()
	{
		if($this->scope_instance)
			$this->scope_instance->persist();
	}
}