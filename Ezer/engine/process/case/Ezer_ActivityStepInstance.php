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
 * Purpose:     Stores a single instance for the execution of an activity step for a specified case
 * @author Tan-Tan
 * @package Engine
 * @subpackage Process.Case
 */
class Ezer_ActivityStepInstance extends Ezer_StepInstance
{
	protected $activity;
	
	public function __construct($id, Ezer_ScopeInstance &$scope_instance, Ezer_ActivityStep $step)
	{
		parent::__construct($id, $scope_instance, $step);
		
		$class = $step->getClass();
		if(!class_exists($class))
			throw new Ezer_StepActivityClassNotFoundException($class);
			
		if(!is_subclass_of($class, 'Ezer_Activity'))
			throw new Ezer_StepClassNotActivityException($class);
			
		$this->activity = new $class();
	}
	
	protected function execute()
	{
		return $this->activity->execute($this->scope_instance->getValues($this->step->getArgs()));
	}
	
	public function shouldRunOnServer()
	{
		return ($this->activity instanceof Ezer_SynchronousActivity);
	}
	
	public function getWorkerAndStart()
	{
		$this->setStatus(Ezer_StepInstanceStatus::STARTED);
		$this->activity->setArgs($this->scope_instance->getValues($this->step->getArgs()));
		return $this->activity;
	}
	
	public function start()
	{
		parent::start();
		
		if($this->execute())
			$this->done();
		else
			$this->retry();	
	}
	
	/**
	 * @return int
	 */
	public function getType()
	{
		return Ezer_IntStep::STEP_TYPE_ACTIVITY;
	}
}

