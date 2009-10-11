<?php
require_once 'Ezer_StepInstance.php';

/**
 * @author Tan-Tan
 * @package Engine
 * @subpackage Process.Case
 */
class Ezer_StepContainerInstance extends Ezer_StepInstance
{
	protected $step_instances;
	protected $available_instances;
	
	public function __construct(Ezer_BusinessProcessInstance &$process_instance, Ezer_StepContainer $step)
	{
		parent::__construct($process_instance, $step);
	}
	
	public function shouldRunOnServer()
	{
		return true;
	}
	
	public function start()
	{
		parent::start();
		
		foreach($this->step->steps as $step)
		{
			$step_instance = $step->createInstance($this->process_instance);
			$this->step_instances[] = $step_instance;
			
			if(count($step->in_flows))
				continue;
				
			$step_instance->flow();
		}
	}
}