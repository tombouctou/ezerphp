<?php


/**
 * Skeleton subclass for performing query and update operations on the 'bp_cases' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    lib.model
 */
class Ezer_PropelCasePeer extends BaseEzer_PropelCasePeer implements Ezer_IntPeer {


	/**
	 * Retrieve all cases that could be started
	 *
	 * @param      PropelPDO $con the connection to use
	 * @return     Ezer_PropelCase
	 */
	public static function retrieveReadyToStart(PropelPDO $con = null)
	{
		$criteria = new Criteria(Ezer_PropelCasePeer::DATABASE_NAME);
		$criteria->add(Ezer_PropelCasePeer::STATUS, Ezer_IntStep::STEP_STATUS_ACTIVE);
		$criteria->add(Ezer_PropelCasePeer::NEXT_EXCUTION_TIME, time(), Criteria::LESS_EQUAL);

		return Ezer_PropelCasePeer::doSelect($criteria, $con);
	}
} // Ezer_PropelCasePeer
