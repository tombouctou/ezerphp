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
abstract class Ezer_PropelStepContainerInstance extends Ezer_PropelStepInstance implements Ezer_IntStepContainerInstance 
{
	/**
	 * @return array<Ezer_IntStep>
	 */
	public function getSteps()
	{
		return Ezer_PropelStepInstancePeer::retrieveChildSteps($this->getId(), $this->getType());
	}
	
} // Ezer_PropelScope
