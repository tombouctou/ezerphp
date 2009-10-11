<?php

/**
 * @author Tan-Tan
 * @package Engine
 * @subpackage Process.Case
 */
class Ezer_AssignStepInstance extends Ezer_StepInstance
{
	public function __construct(Ezer_BusinessProcessInstance &$process_instance, Ezer_AssignStep $step)
	{
		parent::__construct($process_instance, $step);
	}
	
	protected function execute()
	{
		$from = $this->step->copy->from;
		$to = $this->step->copy->to;
		
		$from_variable = $from->getVariable();
		$to_variable = $to->getVariable();
		
		if(!isset($this->process_instance->variables[$from_variable]))
			return false;
			
		$this->process_instance->variables[$from_variable] = $this->process_instance->variables[$to_variable];
		echo "variable set\n";
		return true;
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

?>