<?php


/**
 * Skeleton subclass for representing a row from the 'bp_scopes' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    lib.model
 */
class Ezer_PropelActivityStep extends Ezer_PropelStep implements Ezer_IntActivityStep 
{
	public function __construct()
	{
		parent::__construct();
		$this->dataObject = new Ezer_PropelActivityStepData();
		$this->setType(Ezer_IntStep::STEP_TYPE_ACTIVITY);
	}
	
	/**
	 * @return array<string>
	 */
	public function getArgs()
	{
		return $this->dataObject->getArgs();
	}
	
	/**
	 * @param array<string> $args
	 */
	public function setArgs(array $args)
	{
		$this->dataObject->setArgs($args);
	}
	
	/**
	 * @return string
	 */
	public function getClass()
	{
		return $this->dataObject->getClass();
	}
	
	/**
	 * @param string $class
	 */
	public function setClass($class)
	{
		$this->dataObject->setClass($class);
	}

	
	/**
	 * @param Ezer_ScopeInstance $scope_instance
	 * @return Ezer_PropelActivityStepInstance
	 */
	public function &createInstance(Ezer_ScopeInstance $scope_instance)
	{
		$ret = new Ezer_PropelActivityStepInstance();
		$ret->setContainer($scope_instance);
		$ret->setStepId($this->getId());
		$ret->setName($this->getName());
		$ret->save();
		
		return $ret;
	}
	
} // Ezer_PropelScope
