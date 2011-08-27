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
 * e-mail to johnathan.kanarek@gmail.com
 */



/**
 * Purpose:     Stores a single instance for the execution of steps container for a specified case
 * @author Tan-Tan
 * @package Engine
 * @subpackage Process.Case
 */
abstract class Ezer_StepContainerInstance extends Ezer_StepInstance implements Ezer_IntStepContainerInstance
{
	public $step_instances = array();
	
	/**
	 * @param Ezer_ScopeInstance $scope_instance
	 * @param Ezer_StepContainer $step_container
	 */
	public function __construct($id, Ezer_ScopeInstance &$scope_instance, Ezer_StepContainer $step_container = null)
	{
		parent::__construct($id, $scope_instance, $step_container);
	}
	
	/* (non-PHPdoc)
	 * @see engine/process/case/Ezer_StepInstance#shouldRunOnServer()
	 */
	public function shouldRunOnServer()
	{
		return true;
	}

	/**
	 * @param string $name
	 * @return Ezer_StepInstance
	 */
	protected function &getStepInstance($name)
	{
		foreach($this->step_instances as &$step_instance)
			if($step_instance->getName() == $name)
				return $step_instance;
				
		$null = null;
		return $null;
	}

	/**
	 * @param int $index
	 * @return Ezer_StepInstance
	 */
	public function &getStepInstanceByIndex($index)
	{
		return $this->step_instances[$index];
	}

	/**
	 * @return array<Ezer_StepInstance>
	 */
	public function getStepInstances()
	{
		return $this->step_instances;
	}
	
	/**
	 * Starts the step
	 */
	public function start()
	{
		parent::start();
		
		if($this->step)
		{
			foreach($this->step->steps as &$step)
			{
				$step_instance = &$step->createInstance($this->scope_instance);
				$this->step_instances[] = &$step_instance;
			}
		}
		
		foreach($this->step_instances as &$step_instance)
		{
			if(!$step_instance->getInFlowsCount())
				$step_instance->flow();
		}
	}
}