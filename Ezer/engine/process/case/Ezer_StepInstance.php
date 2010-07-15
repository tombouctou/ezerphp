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
	
	public static function getName($status)
	{
		switch($status)
		{
			case self::LOADED:
				return "Loaded";
				
			case self::AVAILABLE:
				return "Available";
				
			case self::QUEUED:
				return "Queued";
				
			case self::STARTED:
				return "Started";
				
			case self::HANDLED:
				return "Handled";
				
			case self::DONE:
				return "Done";
				
			case self::FAILED:
				return "Failed";
		}
	}
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
	 * @var string
	 */
	protected $id;
	
	/**
	 * @var int
	 */
	protected $progress = 0;
	
	/**
	 * @var Ezer_ScopeInstance
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
	
	public function __construct($id, Ezer_StepContainerInstance &$scope_instance, Ezer_Step $step = null)
	{
		$this->id = $id;
		$this->attempts = 0;
		$this->scope_instance = &$scope_instance;
		
		if($step)
		{
			$this->max_retries = $step->getMaxRetries();
			$this->step = $step;
		}
		
		if($this !== $scope_instance)
		{
//			echo "Adding $id [" . get_class($this) . "] to " . $scope_instance->getId() . "[" . get_class($scope_instance) . "]\n";
			$this->scope_instance->step_instances[] = &$this;
			
			$parent_scope_instance = $scope_instance->getScopeInstance();
			if($parent_scope_instance)
			{
//				echo "Adding $id [" . get_class($this) . "] to " . $parent_scope_instance->getId() . "[" . get_class($parent_scope_instance) . "]\n";
				$parent_scope_instance->step_instances[] = &$this;
			}
		}
			
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
		if($status == Ezer_StepInstanceStatus::FAILED)
		{
			$trace = debug_backtrace(false);
			foreach($trace as $tr)
				Ezer_Log::debug($tr['file'] . ': ' . $tr['line'] . ': ' . $tr['function']);
		}
		Ezer_Log::debug("Status changed " . get_class($this) . "[" . $this->getName() . "] status " . Ezer_StepInstanceStatus::getName($status));
		
		$this->status = $status;
		$this->persist();
	}
	
	public function getStatus()
	{
		return $this->status;
	}
	
	public function getStepId()
	{
		if(!$this->step)
			return null;
			
		return $this->step->getId();
	}
	
	public function &getScopeInstance()
	{
		return $this->scope_instance;
	}
	
	/**
	 * @param string $step_id
	 */
	public function flow($step_id = null)
	{
		if(is_null($step_id) && (!$this->step || !$this->step->getInFlowsCount()))
		{
			$this->setStatus(Ezer_StepInstanceStatus::AVAILABLE);
			return true;
		}

		if(!$this->step || !$this->step->hasInFlow($step_id))
		{
			return false;
		}
			
		$this->flowed_in[$step_id] = true;
		if($this->status != Ezer_StepInstanceStatus::LOADED)
		{
			return true;
		}
			
		if($this->step && ($this->step->getJoinPolicy() == Ezer_StepJoinPolicy::JOIN_OR || count($this->flowed_in) >= $this->step->getInFlowsCount()))
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
		if(!$this->step)
			return null;
			
		return $this->step->getName();
	}
	
	public function getOutFlows()
	{
		if(!$this->step)
			return 0;
			
		return $this->step->getOutFlows();
	}
	
	public function getInFlowsCount()
	{
		if(!$this->step)
			return 0;
			
		return $this->step->getInFlowsCount();
	}
	
	public function getPriority()
	{
		if(!$this->step)
			return 0;
			
		return min(1, max(10, $this->step->getPriority())); 
	}
	
	public function failed($err)
	{
		Ezer_Log::err(get_class($this) . " [" . $this->getName() . "] failed ($err)");
		
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
	public function setVariableByPath($variable_path, $value)
	{
		$this->scope_instance->setVariableByPath($variable_path, $value);
	}
	
	public function setVariable(Ezer_AssignStepToAttribute $to, $value)
	{
		$this->scope_instance->setVariable($to, $value);
	}
	
	public function addVariable(Ezer_AssignStepToAttribute $to, $value)
	{
		$this->scope_instance->addVariable($to, $value);
	}
	
	public function persist()
	{
		if($this->scope_instance)
			$this->scope_instance->persist();
	}
}