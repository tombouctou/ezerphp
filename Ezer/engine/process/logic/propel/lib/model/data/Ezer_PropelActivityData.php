<?php


/**
 * @package    lib.model.data
 */
class Ezer_PropelActivityStepData extends Ezer_PropelData 
{
	protected $args = array();
	protected $class = 'Ezer_Activity';
	
	/**
	 * @return array<string>
	 */
	public function getArgs()
	{
		return $this->args;
	}
	
	/**
	 * @param array<string> $args
	 */
	public function setArgs(array $args)
	{
		$this->args = $args;
	}
	
	/**
	 * @return string
	 */
	public function getClass()
	{
		return $this->class;
	}
	
	/**
	 * @param string $class
	 */
	public function setClass($class)
	{
		$this->class = $class;
	}
}
