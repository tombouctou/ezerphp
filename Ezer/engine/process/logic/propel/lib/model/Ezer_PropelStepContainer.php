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
abstract class Ezer_PropelStepContainer extends Ezer_PropelStep implements Ezer_IntStepContainer 
{
	/**
	 * @return array<Ezer_IntStep>
	 */
	public function getSteps()
	{
		return Ezer_PropelStepPeer::retrieveChildSteps($this->getId(), $this->getType());
	}
	
} // Ezer_PropelScope
