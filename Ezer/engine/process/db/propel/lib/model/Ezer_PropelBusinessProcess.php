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
	
} // Ezer_PropelBusinessProcess
