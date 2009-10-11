<?php

/**
 * @author Tan-Tan
 * @package Engine
 * @subpackage Process.Case
 */
class Ezer_BusinessProcessInstance
{
	public $variables = array();
	public $process;
	public $sequence_instance;
	public $steps = array();
	
	public function __construct(array $variables, Ezer_BusinessProcess $process)
	{
		$this->variables = $variables;
		$this->process = $process;
		$this->sequence_instance = $process->getSequence()->createInstance($this);
		$this->start();
	}
	
	public function getValues(Ezer_Array $args)
	{
		$return = array();
		foreach($args as $arg)
		{
			if(is_null($arg))
				continue;
				
			if(isset($this->variables[$arg]))
				$return[$arg] = $this->variables[$arg];
		}
				
		return $return;
	}
	
	public function start()
	{
		$this->sequence_instance->start();
	}
}