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
class Ezer_ForeachInstance extends Ezer_StepContainerInstance
{
	/**
	 * @var string $arg items array arg name
	 */
	protected $arg;
	
	/**
	 * @var int paralell or serial
	 */
	protected $order_type;
	
	/**
	 * @var int paralell or serial
	 */
	protected $current_index = 0;
	
	public function __construct($id, Ezer_ScopeInstance &$scope_instance, Ezer_Foreach $foreach)
	{
		parent::__construct($id, $scope_instance, $foreach);
		
		$this->arg = $foreach->getArg();
		$this->order_type = $foreach->getOrderType();
	}
	
	public function startStep($item)
	{
		$var = new Ezer_AssignStepToAttribute('item');
		
		$scope_instance = $this->scope_instance->spawn();
		$scope_instance->addVariable($var, $item);
		$this->step_instances[] = $scope_instance;
	
		foreach($this->step->steps as &$step)
		{
			$step_instance = &$step->createInstance($scope_instance);
			
			if($this->order_type == Ezer_IntForeach::TYPE_PARALLEL)
				$scope_instance->start();
		}
	}
	
	public function start()
	{
		$this->started();
	
		$items = $this->scope_instance->getVariableValue($this->arg);
		foreach($items as $item)
			$this->startStep($item);
		
		if($this->order_type == Ezer_IntForeach::TYPE_SERIAL)
			$this->step_instances[0]->start();
	}
	
	public function isAvailable()
	{
		if(!$this->isStarted())
			return parent::isAvailable();
			
		if($this->order_type == Ezer_IntForeach::TYPE_PARALLEL)
		{
			foreach($this->step_instances as $index => $step_instance)
			{
				if(!$step_instance->isDone())
					return false;
			}
			$this->done();
		}
	
		if($this->order_type == Ezer_IntForeach::TYPE_SERIAL)
		{
			$step_instance = $this->step_instances[$this->current_index];
			if(!$step_instance->isDone())
					return false;
					
			$this->current_index++;
			if($this->current_index >= count($this->step_instances))
			{
				$this->done();
			}
			else
			{
				$step_instance = $this->step_instances[$this->current_index];
				$step_instance->start();	
			}
		}
		
		return false;
	}
	
	/**
	 * @return int
	 */
	public function getType()
	{
		return Ezer_IntStep::STEP_TYPE_FOREACH;
	}
}

