<?php
require_once dirname(__FILE__) . '/../case/Ezer_SequenceInstance.php';
require_once 'Ezer_StepContainer.php';

/**
 * @author Tan-Tan
 * @package Engine
 * @subpackage Process.Logic
 */
class Ezer_Sequence extends Ezer_StepContainer
{
	public function createInstance(Ezer_BusinessProcessInstance $process_instance)
	{
		return new Ezer_SequenceInstance($process_instance, $this);
	}
	
	public function add(Ezer_Step $step)
	{
		// overwrite any flow definition
		$step->in_flows = array();
		$step->out_flows = array();
		
		parent::add($step);
		
		$last_index = count($this->steps) - 1;
		if($last_index <= 0)
			return;
			
		$last_step = &$this->steps[$last_index];
		$prev_step = &$this->steps[$last_index - 1];
		$last_step->in_flows[$prev_step->id] = $prev_step;
		$prev_step->out_flows[$last_step->id] = $last_step;
	}
}

?>