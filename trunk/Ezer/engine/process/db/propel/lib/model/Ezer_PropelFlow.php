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
class Ezer_PropelFlow extends Ezer_PropelStepContainer implements Ezer_IntFlow 
{
	public function __construct()
	{
		parent::__construct();
		$this->dataObject = new Ezer_PropelFlowData();
		$this->setType(Ezer_IntStep::STEP_TYPE_FLOW);
	}

	
	/**
	 * @param Ezer_ScopeInstance $scope_instance
	 * @return Ezer_PropelFlowInstance
	 */
	public function &createInstance(Ezer_ScopeInstance $scope_instance)
	{
		$ret = new Ezer_PropelFlowInstance();
		$ret->setContainer($scope_instance);
		$ret->setStepId($this->getId());
		$ret->setName($this->getName());
		$ret->save();
		
		return $ret;
	}
} // Ezer_PropelScope
