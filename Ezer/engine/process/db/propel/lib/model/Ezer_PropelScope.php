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
class Ezer_PropelScope extends Ezer_PropelStepContainer implements Ezer_IntScope 
{
	public function __construct()
	{
		parent::__construct();
		$this->dataObject = new Ezer_PropelScopeData();
		$this->setType(Ezer_IntStep::STEP_TYPE_SCOPE);
	}
	
	/**
	 * @return array<Ezer_Variable>
	 */
	public function getVariables()
	{
		return $this->dataObject->getVariables();
	}
	
	public function addVariable(Ezer_Variable $variable)
	{
		$this->dataObject->addVariable($variable);
	}
	
} // Ezer_PropelScope
