<?php
require_once dirname(__FILE__) . '/../case/Ezer_ActivityStepInstance.php';


/**
 * @author Tan-Tan
 * @package Engine
 * @subpackage Process.Logic
 */
class Ezer_ActivityStep extends Ezer_Step
{
	protected $class;
	
	/**
	 * @mandatory false
	 */
	protected $args;

	public function __set($name, $value) 
	{
		if($name == 'args' && !($value instanceof Ezer_Array))
		{
			$arr = new Ezer_Array();
			$arr->add($value);
			$value = $arr;
		}
			
		parent::__set($name, $value);
	}
	
	public function createInstance(Ezer_BusinessProcessInstance $process_instance)
	{
		return new Ezer_ActivityStepInstance($process_instance, $this);
	}
	
	public function getClass()
	{
		return $this->class;
	}
	
	public function getArgs()
	{
		return $this->args;
	}
}

?>