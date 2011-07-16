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
class Ezer_PropelAssignStep extends Ezer_PropelStep implements Ezer_IntAssignStep 
{
	public function __construct()
	{
		parent::__construct();
		$this->dataObject = new Ezer_PropelAssignStepData();
		$this->setType(Ezer_IntStep::STEP_TYPE_ASSIGN);
	}
	
	public function getCustomFields()
	{
		return array(
			'copies',
		);
	}
		
	/**
	 * @return array<Ezer_AssignStepCopy>
	 */
	public function getCopies()
	{
		return $this->dataObject->getCopies();
	}
	
	/**
	 * @param Ezer_AssignStepCopy $copy
	 */
	public function addCopy(Ezer_AssignStepCopy $copy)
	{
		$this->dataObject->addCopy($copy);
	}

	
	/**
	 * @param Ezer_ScopeInstance $scope_instance
	 * @return Ezer_PropelAssignStepInstance
	 */
	public function &createInstance(Ezer_ScopeInstance $scope_instance)
	{
		$ret = new Ezer_PropelAssignStepInstance();
		$ret->setContainer($scope_instance);
		$ret->setStepId($this->getId());
		$ret->setName($this->getName());
		$ret->save();
		
		return $ret;
	}
	
} // Ezer_PropelScope
