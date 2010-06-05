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
class Ezer_PropelScopeInstance extends Ezer_PropelStepContainerInstance implements Ezer_IntScopeInstance 
{
	public function __construct()
	{
		parent::__construct();
		$this->dataObject = new Ezer_PropelScopeInstanceData();
		$this->setType(Ezer_IntStep::STEP_TYPE_SCOPE);
	}
	
	/**
	 * @return array
	 */
	public function getVariables()
	{
		return $this->dataObject->getVariables();
	}
	
	/**
	 * @param array $variables
	 */
	public function setVariables(array $variables)
	{
		$this->dataObject->setVariables($variables);
	}
	
} // Ezer_PropelScope
