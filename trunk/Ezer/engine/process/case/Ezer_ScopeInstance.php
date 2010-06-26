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
 * Purpose:     Stores a single instance for the execution of a sequence for a specified case
 * @author Tan-Tan
 * @package Engine
 * @subpackage Process.Case
 */
class Ezer_ScopeInstance extends Ezer_StepContainerInstance implements Ezer_IntScopeInstance
{
	/**
	 * @var array
	 */
	protected $variables = array();
	
	/**
	 * @var Ezer_Scope
	 */
	protected $scope = array();
	
	public function __construct($id, array $variables, Ezer_ScopeInstance &$scope_instance, Ezer_Scope $scope = null)
	{
		parent::__construct($id, $scope_instance, $scope);
		$this->variables = $variables;
		$this->scope = $scope;
	}
	
	/**
	 * @return Ezer_ScopeInstance
	 */
	public function &spawn()
	{
		$scope_instance = $this->scope->spawn($this);
		return $scope_instance;
	}
	
	public function getValues(array $args = null)
	{
		if(is_null($args))
			return $this->variables;
		
		$return = array();
		
		foreach($args as $arg)
		{
			if(is_null($arg))
				continue;
				
			if(isset($this->variables[$arg]))
				$return[$arg] = $this->variables[$arg];
		}
				
		return $return;
	}
	
	/**
	 * @param Ezer_AssignStepFromAttribute $from
	 * @return bool
	 */
	public function hasVariable(Ezer_AssignStepFromAttribute $from)
	{
		if(!isset($this->variables[$from->getVariable()]))
			return false;
			
		// TODO - check for from part
		return true;
	}
	
	protected function getValueFromVariable(Ezer_AssignStepFromAttribute $from, $variable)
	{
		if(!$from->hasPart())
			return $variable;
			
		$part = $from->getPart();
		$partVariable = $part->getVariable();
		if(!isset($variable[$partVariable]))
			return null;
			
		return $this->getValueFromVariable($part, $variable[$partVariable]);
	}
	
	public function getVariableValue(Ezer_AssignStepFromAttribute $from)
	{
		if(!isset($this->variables[$from->getVariable()]))
			return null;
		
		return $this->getValueFromVariable($from, $this->variables[$from->getVariable()]);
	}
	
	private function setValue(&$var, Ezer_AssignStepToAttribute $to, $value)
	{
		$variable = $to->getVariable();
	
		if($to->hasPart())
		{
			$part = $to->getPart();
			
			if($part->hasVariable())
			{
				$variable = $part->getVariable();
				
				if(!isset($var[$variable]))
					return false;
					
				return $this->setValue($var[$variable], $part, $value);
			}
			elseif($part->hasPart() && is_array($var))
			{
				$all_set = true;
				
				foreach($var as &$set_var)
					if(!$this->setValue($set_var, $part, $value))
						$all_set = false;
						
				return $all_set;
			}
		}
			
		$var = $value;
		return true;
	}
	
	private function addValue(&$var, Ezer_AssignStepToAttribute $to, $value)
	{
		$variable = $to->getVariable();
	
		if($to->hasPart())
		{
			$part = $to->getPart();
			
			if($part->hasVariable())
			{
				$variable = $part->getVariable();
				
				if(!isset($var[$variable]))
					$var[$variable] = null;
					
				return $this->addValue($var[$variable], $part, $value);
			}
			elseif($part->hasPart() && is_array($var))
			{
				$all_set = true;
				
				foreach($var as &$set_var)
					if(!$this->addValue($set_var, $part, $value))
						$all_set = false;
						
				return $all_set;
			}
		}
			
		$var = $value;
		return true;
	}
	
	private function setValueByPath(&$var, array $path, $value)
	{
		$current = array_pop($path);
		if(!isset($var[$current]))
			return false;
			
		$set_var = &$var[$current];
		
		if(count($path))
		{
			if(is_array($set_var))
				return $this->setValueByPath($set_var, $path, $value);
				
			return false;
		}
		$set_var = $value;
	}
	
	/**
	 * Sets a variable value in the scope instance, on the server.
	 * @param $variable_path string separated by / to the variable and part that should be set
	 * @param $value the new value
	 */
	public function setVariableByPath($variable_path, $value)
	{
		$path = array_reverse(explode('/', $variable_path));
		return $this->setValueByPath($this->variables, $path, $value);
	}
	
	public function addVariable(Ezer_AssignStepToAttribute $to, $value)
	{
		if($this->setVariable($to, $value))
			return true;
		
		$variable = $to->getVariable();
		if(!isset($this->variables[$variable]))
			$this->variables[$variable] = null;
			
		return $this->addValue($this->variables[$variable], $to, $value);
	}
	
	public function setVariable(Ezer_AssignStepToAttribute $to, $value)
	{
		$variable = $to->getVariable();
		if(!isset($this->variables[$variable]))
			return false;
			
		return $this->setValue($this->variables[$variable], $to, $value);
	}
	
	public function isAvailable()
	{
		foreach($this->step_instances as $index => $step_instance)
			if($step_instance->isAvailable())
				return true;
				
		return false;
	}
	
	public function isDone()
	{
		foreach($this->step_instances as $index => $step_instance)
			if(!$step_instance->isDone())
				return false;
				
		return true;
	}
	
	/**
	 * @return array
	 */
	public function getVariables(array $arr = null)
	{
		if(is_null($arr))
			$arr = $this->variables;
			
		$ret = array();
		foreach($arr as $key => $value)
		{
			if(is_array($value))
			{
				$ret[$key] = $this->getVariables($value);
			}
			elseif(is_object($value))
			{
				$ret[$key] = clone $value;
			}
			else
			{
				$ret[$key] = $value;
			}
		}
		
		return $ret;
	}
	
	/**
	 * @param array $variables
	 */
	public function setVariables(array $variables)
	{
		$this->variables = $variables;
	}
	
	/**
	 * @return int
	 */
	public function getType()
	{
		return Ezer_IntStep::STEP_TYPE_SCOPE;
	}
}

