<?php
require_once 'Ezer_StepContainerInstance.php';

/**
 * @author Tan-Tan
 * @package Engine
 * @subpackage Process.Case
 */
class Ezer_SequenceInstance extends Ezer_StepContainerInstance
{
	public function __construct(Ezer_BusinessProcessInstance &$process_instance, Ezer_Sequence $step)
	{
		parent::__construct($process_instance, $step);
	}
	
	public function start()
	{
		parent::start();
	}
	
	public function isAvailable()
	{
		if(!parent::isStarted())
			return parent::isAvailable();
			
		foreach($this->step_instances as $index => $step_instance)
		{
			if(!$step_instance->isDone())
				break;
				
			$index++;
			if(count($this->step_instances) <= $index)
			{
				$this->done();
			}
			else
			{
				$next_step = &$this->step_instances[$index];
				$next_step->flow($step_instance->getStepId());
			}
		}
		
		return false;
	}
}