<?php
require_once dirname(__FILE__) . '/../case/Ezer_StepContainerInstance.php';
require_once 'Ezer_Step.php';

/**
 * @author Tan-Tan
 * @package Engine
 * @subpackage Process.Logic
 */
abstract class Ezer_StepContainer extends Ezer_Step
{
	public $steps = array();
	
	public function add(Ezer_Step $step)
	{
		$this->steps[] = $step;
	}
}

?>