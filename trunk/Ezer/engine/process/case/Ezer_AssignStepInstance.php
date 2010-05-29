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
 * Purpose:     Stores a single instance for the execution of a business process for a specified case
 * @author Tan-Tan
 * @package Engine
 * @subpackage Process.Case
 */
class Ezer_AssignStepInstance extends Ezer_StepInstance
{
	public function __construct(Ezer_ScopeInstance  &$scope_instance, Ezer_AssignStep $step)
	{
		parent::__construct($scope_instance, $step);
	}
	
	protected function execute()
	{
		$all_set = true;
		
		foreach($this->step->copies as $copy)
		{
			$from = $copy->from;
			$to = $copy->to;
			
			$value = null;
			$should_set = false;
			
			if($from->hasValue())
			{
				$value = $from->getValue();
				$should_set = true;
			}
			else
			{
				if($this->scope_instance->hasVariable($from))
				{
					$value = $this->scope_instance->getVariableValue($from);
					$should_set = true;
				}
				else
				{
					$all_set = false;
				}
			}
				
			if($should_set)
				if(!$this->scope_instance->setVariable($to, $value))
					$all_set = false;
		}
		
		return $all_set;
	}
	
	public function shouldRunOnServer()
	{
		return true;
	}
	
	public function start()
	{
		parent::start();
		
		if($this->execute())
			$this->done();
		else
			$this->retry();	
	}
}

