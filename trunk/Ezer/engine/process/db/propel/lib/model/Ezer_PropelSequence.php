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
class Ezer_PropelSequence extends Ezer_PropelStepContainer implements Ezer_IntSequence 
{
	public function __construct()
	{
		parent::__construct();
//		$this->dataObject = new Ezer_PropelSequenceData();
		$this->setType(Ezer_IntStep::STEP_TYPE_SEQUENCE);
	}

	
	/**
	 * @param Ezer_ScopeInstance $scope_instance
	 * @return Ezer_PropelSequenceInstance
	 */
	public function &createInstance(Ezer_ScopeInstance $scope_instance)
	{
		$ret = new Ezer_PropelSequenceInstance();
		$ret->setContainer($scope_instance);
		$ret->setStepId($this->getId());
		$ret->setName($this->getName());
		$ret->save();
		
		return $ret;
	}
} // Ezer_PropelScope
