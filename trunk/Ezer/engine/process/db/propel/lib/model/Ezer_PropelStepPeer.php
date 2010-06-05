<?php


/**
 * Skeleton subclass for performing query and update operations on the 'bp_steps' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    lib.model
 */
class Ezer_PropelStepPeer extends BaseEzer_PropelStepPeer {


	/**
	 * The returned array will contain objects of the default type or
	 * objects that inherit from the default.
	 *
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function populateObjects(PDOStatement $stmt)
	{
		$typePosition = Ezer_PropelStepPeer::translateFieldName(Ezer_PropelStepPeer::TYPE, BasePeer::TYPE_COLNAME, BasePeer::TYPE_NUM);
		$results = array();
		
		// populate the object(s)
		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key = Ezer_PropelStepPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj = Ezer_PropelStepPeer::getInstanceFromPool($key))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://propel.phpdb.org/trac/ticket/509
				// $obj->hydrate($row, 0, true); // rehydrate
				$results[] = $obj;
			} else {
				$type = $row[$typePosition];
				$obj = self::newStep($type);
				$obj->hydrate($row);
				$results[] = $obj;
				Ezer_PropelStepPeer::addInstanceToPool($obj, $key);
			} // if key exists
		}
		$stmt->closeCursor();
		return $results;
	}
	
	/**
	 * Instantiate new Step object
	 *
	 * @param      int $type
	 * @return     Ezer_PropelStep
	 */
	public static function newStep($type)
	{
		switch($type)
		{
			case Ezer_IntStep::STEP_TYPE_PROCESS:
				return new Ezer_PropelBusinessProcess();
		
			case Ezer_IntStep::STEP_TYPE_SCOPE:
				return new Ezer_PropelScope();
		
			case Ezer_IntStep::STEP_TYPE_FLOW:
				return new Ezer_PropelFlow();
		
			case Ezer_IntStep::STEP_TYPE_SEQUENCE:
				return new Ezer_PropelSequence();
		
			case Ezer_IntStep::STEP_TYPE_ACTIVITY:
				return new Ezer_PropelActivityStep();
		
			case Ezer_IntStep::STEP_TYPE_ASSIGN:
				return new Ezer_PropelAssignStep();
		
			case Ezer_IntStep::STEP_TYPE_IF:
				return new Ezer_PropelIf();
			
//			case Ezer_IntStep::STEP_TYPE_FOREACH:
//				return new Ezer_PropelForeach();
//		
//			case Ezer_IntStep::STEP_TYPE_REPEAT_UNTIL:
//				return new Ezer_PropelRepeatUntil();
//		
//			case Ezer_IntStep::STEP_TYPE_WHILE:
//				return new Ezer_PropelWhile();
//		
//			case Ezer_IntStep::STEP_TYPE_SWITCH:
//				return new Ezer_PropelSwitch();
//		
//			case Ezer_IntStep::STEP_TYPE_EMPTY:
//				return new Ezer_PropelEmpty();
//		
//			case Ezer_IntStep::STEP_TYPE_WAIT:
//				return new Ezer_PropelWait();
//		
//			case Ezer_IntStep::STEP_TYPE_TERMINATE:
//				return new Ezer_PropelTerminate();
//		
//			case Ezer_IntStep::STEP_TYPE_THROW:
//				return new Ezer_PropelThrow();
//
//			case Ezer_IntStep::STEP_TYPE_RETHROW:
//				return new Ezer_PropelRethrow();
		}
	}
	
	/**
	 * Retrieve all active processes
	 *
	 * @param      PropelPDO $con the connection to use
	 * @return     Ezer_PropelStep
	 */
	public static function retrieveActiveProcesses(PropelPDO $con = null)
	{
		$criteria = new Criteria();
		$criteria->add(Ezer_PropelStepPeer::STATUS, Ezer_IntStep::STEP_STATUS_ACTIVE);
		$criteria->add(Ezer_PropelStepPeer::TYPE, Ezer_IntStep::STEP_TYPE_PROCESS);

		return self::doSelect($criteria, $con);
	}
	
	/**
	 * Retrieve all active processes
	 *
	 * @param      string $name
	 * @param      PropelPDO $con the connection to use
	 * @return     Ezer_PropelStep
	 */
	public static function retrieveProcessByName($name, PropelPDO $con = null)
	{
		$criteria = new Criteria();
		$criteria->add(Ezer_PropelStepPeer::NAME, $name);
		$criteria->add(Ezer_PropelStepPeer::STATUS, Ezer_IntStep::STEP_STATUS_ACTIVE);
		$criteria->add(Ezer_PropelStepPeer::TYPE, Ezer_IntStep::STEP_TYPE_PROCESS);

		return self::doSelectOne($criteria, $con);
	}
	
	/**
	 * Retrieve all active child steps
	 *
	 * @param      PropelPDO $con the connection to use
	 * @return     array<Ezer_PropelStep>
	 */
	public static function retrieveChildSteps($containerId, $containerType, PropelPDO $con = null)
	{
		$criteria = new Criteria();
		$criteria->add(Ezer_PropelStepPeer::STATUS, Ezer_IntStep::STEP_STATUS_ACTIVE);
		$criteria->add(Ezer_PropelStepPeer::CONTAINER_ID, $containerId);
		$criteria->add(Ezer_PropelStepPeer::CONTAINER_TYPE, $containerType);

		return self::doSelect($criteria, $con);
	}
	
	
} // Ezer_PropelStepPeer
