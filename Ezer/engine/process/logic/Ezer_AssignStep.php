<?php
require_once dirname(__FILE__) . '/../case/Ezer_AssignStepInstance.php';

/**
 * @author Tan-Tan
 * @package Engine
 * @subpackage Process.Logic
 */
class Ezer_AssignStepCopyAttribute extends Ezer_Loadable
{
	protected $variable;
	
	
	/**
	 * @mandatory false
	 */
	protected $part;	
	
	public function getVariable()
	{
		return $this->variable;
	}
	
	public function getPart()
	{
		return $this->part;
	}
}

/**
 * @author Tan-Tan
 * @package Engine
 * @subpackage Process.Logic
 */
class Ezer_AssignStepCopy extends Ezer_Loadable
{
	public $from;
	public $to;	
	
	public function __construct()
	{
	}
}

/**
 * @author Tan-Tan
 * @package Engine
 * @subpackage Process.Logic
 */
class Ezer_AssignStep extends Ezer_Step
{
	public $copy;
	
	public function __construct()
	{
	}
	
	public function createInstance(Ezer_BusinessProcessInstance $process_instance)
	{
		return new Ezer_AssignStepInstance($process_instance, $this);
	}
}

?>