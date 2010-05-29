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



require_once 'Ezer_StepContainerInstance.php';


/**
 * Purpose:     Stores a single instance for the execution of a sequence for a specified case
 * @author Tan-Tan
 * @package Engine
 * @subpackage Process.Case
 */
class Ezer_ScopeInstance extends Ezer_StepContainerInstance
{
	public $variables = array();
	
	public function __construct(array $variables, Ezer_ScopeInstance &$scope_instance, Ezer_Scope $scope)
	{
		parent::__construct($this, $scope);
		$this->variables = $variables;
	}
	
	public function getValues($args)
	{
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
	
	public function hasVariable(Ezer_AssignStepFromAttribute $from)
	{
		if(!isset($this->variables[$from->getVariable()]))
			return false;
			
		// TODO - check for from part
		return true;
	}
	
	public function getVariable(Ezer_AssignStepFromAttribute $from)
	{
		if(!isset($this->variables[$from->getVariable()]))
			return null;
			
		// TODO - check for from part
		return $this->variables[$from->getVariable()];
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
				
//				echo $to->getVariable() .  " has part " . $part->getVariable() . "\n";
				
				if(!isset($var[$variable]))
				{
//					echo "couldnt find part $variable\n";
					return false;
				}
					
				return $this->setValue($var[$variable], $part, $value);
			}
			elseif($part->hasPart() && is_array($var))
			{
				$all_set = true;
//				$part_part = $part->getPart();
//				echo "array part has part " . $part->getPart()->getVariable() . "\n";
				
				foreach($var as &$set_var)
					if(!$this->setValue($set_var, $part, $value))
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
			if(!is_array($set_var))
				return false;
				
			return $this->setValueByPath($set_var, $path, $value);
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
		$path = array_reverse(split('/', $variable_path));
		return $this->setValueByPath($this->variables, $path, $value);
	}
	
	public function setVariable(Ezer_AssignStepToAttribute $to, $value)
	{
		$variable = $to->getVariable();
		if(!isset($this->variables[$variable]))
			return false;
			
//		echo "before set\n";
//		var_dump($this->variables[$variable]);
		
		$ret = $this->setValue($this->variables[$variable], $to, $value);
		
//		echo "after set\n";
//		var_dump($this->variables[$variable]);
		
		return $ret;
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
}

?>