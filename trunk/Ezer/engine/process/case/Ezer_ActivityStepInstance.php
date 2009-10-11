<?php
require_once dirname(__FILE__) . '/../errors/Ezer_StepActivityClassNotFoundException.php';
require_once dirname(__FILE__) . '/../errors/Ezer_StepClassNotActivityException.php';

/**
 * @author Tan-Tan
 * @package Engine
 * @subpackage Process.Case
 */
class Ezer_ActivityStepInstance extends Ezer_StepInstance
{
	protected $activity;
	
	public function __construct(Ezer_BusinessProcessInstance &$process_instance, Ezer_ActivityStep $step)
	{
		parent::__construct($process_instance, $step);
		
		$class = $step->getClass();
		if(!class_exists($class))
			throw new Ezer_StepClassNotFoundException($class);
			
		if(!is_subclass_of($class, Ezer_Activity))
			throw new Ezer_StepClassNotActivityException($class);
			
		$this->activity = new $class();
	}
	
	protected function execute()
	{
		return $this->activity->execute($this->process_instance->getValues($this->step->getArgs()));
	}
	
	public function shouldRunOnServer()
	{
		return ($this->activity instanceof Ezer_SynchronousActivity);
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