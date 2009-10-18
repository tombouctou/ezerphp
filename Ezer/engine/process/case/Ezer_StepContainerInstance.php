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


require_once 'Ezer_StepInstance.php';


/**
 * Purpose:     Stores a single instance for the execution of steps container for a specified case
 * @author Tan-Tan
 * @package Engine
 * @subpackage Process.Case
 */
class Ezer_StepContainerInstance extends Ezer_StepInstance
{
	public $step_instances = array();
	
	public function __construct(Ezer_ScopeInstance &$scope_instance, Ezer_StepContainer $step_container)
	{
		parent::__construct($scope_instance, $step_container);
	}
	
	public function shouldRunOnServer()
	{
		return true;
	}

	protected function &getStepInstance($name)
	{
		foreach($this->step_instances as &$step_instance)
			if($step_instance->getName() == $name)
				return $step_instance;
				
		$null = null;
		return $null;
	}
	
	public function start()
	{
		parent::start();
		
		foreach($this->step->steps as &$step)
		{
			$step_instance = &$step->createInstance($this->scope_instance);
			$this->step_instances[] = &$step_instance;
			
			if(count($step->in_flows))
				continue;
				
			$step_instance->flow();
		}
	}
}