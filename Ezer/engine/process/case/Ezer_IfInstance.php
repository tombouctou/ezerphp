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
require_once 'Ezer_ScopeInstance.php';


/**
 * Purpose:     Stores a single instance for the execution of a sequence for a specified case
 * @author Tan-Tan
 * @package Engine
 * @subpackage Process.Case
 */
class Ezer_IfInstance extends Ezer_StepContainerInstance
{
	private $condition_results = false;
	private $else_instance = null;
	private $elseif_instance = null;
	
	public function __construct(Ezer_ScopeInstance &$scope_instance, Ezer_If $if)
	{
		parent::__construct($scope_instance, $if);
	}
	
	public function start()
	{
		$this->started();
	
		$this->evaluateCondition();
		
		if($this->condition_results)
		{
			if(!count($this->step->steps))
			{
				$this->done();
			}
			else
			{
				$step = &$this->step->steps[0];
				$step_instance = &$step->createInstance($this->scope_instance);
				$this->step_instances[] = &$step_instance;
				$step_instance->flow();
			}
			return;
		}
		
		foreach($this->step->elseifs as &$elseif)
		{
			$elseif_instance = &$elseif->createInstance($this->scope_instance);
			$condition_results = $elseif_instance->evaluateCondition();
			if($condition_results)
			{
				$this->else_instance = &$elseif_instance;
				$elseif_instance->flow();
				return;
			}
		}
		
		if($this->step->else)
		{
			$else = &$this->step->else;
			$else_instance = &$else->createInstance($this->scope_instance);
			$this->else_instance = &$else_instance;
			$else_instance->flow();
			return;
		}
		
		$this->done();
	}
	
	public function evaluateCondition()
	{
		$condition = $this->step->getCondition();
		$this->condition_results = false;
		
		if(preg_match_all('/\$([^\s]+)/', $condition, $arr))
		{
			$vars = $arr[0];
			$var_names = $arr[1];
			$values = $this->scope_instance->getValues($var_names);
			
			$condition = str_replace($vars, $values, $condition);
			eval("\$this->condition_results = ($condition);");
		}
		
		return $this->condition_results;
	}
	
	public function isAvailable()
	{
		if(!parent::isStarted())
			return parent::isAvailable();
			
		if($this->condition_results)
		{
			$step_instance = $this->step_instances[0];
			if($step_instance->isDone())
				$this->done();
				
			return false;
		}
		
		if($this->elseif_instance && $this->elseif_instance->condition_results)
		{
			if($this->elseif_instance->isDone())
				$this->done();
				
			return false;
		}
		
		if($this->else_instance)
		{
			if($this->else_instance->isDone())
				$this->done();
		}
		return false;
	}
}

?>