<?php


/**
 * Skeleton subclass for representing a row from the 'business_processes' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    lib.model
 */
class Ezer_PropelBusinessProcess extends Ezer_PropelScope implements Ezer_IntBusinessProcess
{
	public function __construct()
	{
		parent::__construct();
		$this->dataObject = new Ezer_PropelBusinessProcessData();
		$this->setType(Ezer_IntStep::STEP_TYPE_PROCESS);
	}
	
	/**
	 * @return array<string>
	 */
	public function getImports()
	{
		return array(); //TODO
	}
	
	/**
	 * @param Ezer_Case $case
	 * @return Ezer_PropelBusinessProcessInstance
	 */
	public function &createBusinessProcessInstance(Ezer_Case $case)
	{
		$ret = new Ezer_PropelBusinessProcessInstance();
		$ret->setProcessId($this->getId());
		$ret->setCaseId($case->getId());
		$ret->setStepId($this->getId());
		$ret->setName($this->getName());
		$ret->setVariables($case->getVariables());
		$ret->save();
		
		return $ret;
	}
	
	public function &spawn(Ezer_ScopeInstance $scope_instance)
	{
		$ret = new Ezer_PropelScopeInstance();
		$ret->setProcessId($this->getId());
		$ret->setContainer($scope_instance);
		$ret->setStepId($this->getId());
		$ret->setName($this->getName());
		$ret->setVariables($scope_instance->getVariables());
		$ret->save();
		
		return $ret;
	}
	
} // Ezer_PropelBusinessProcess
