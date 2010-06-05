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
class Ezer_PropelBusinessProcessInstance extends Ezer_PropelScopeInstance implements Ezer_IntBusinessProcessInstance
{
	public function __construct()
	{
		parent::__construct();
		$this->dataObject = new Ezer_PropelBusinessProcessInstanceData();
		$this->setType(Ezer_IntStep::STEP_TYPE_PROCESS);
	}
}
