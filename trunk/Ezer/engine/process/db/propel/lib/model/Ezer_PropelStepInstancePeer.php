<?php


/**
 * Skeleton subclass for performing query and update operations on the 'bp_step_instances' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    lib.model
 */
class Ezer_PropelStepInstancePeer extends BaseEzer_PropelStepInstancePeer implements Ezer_IntPeer {

	/**
	 * The returned array will contain objects of the default type or
	 * objects that inherit from the default.
	 *
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function populateObjects(PDOStatement $stmt)
	{
		$typePosition = Ezer_PropelStepInstancePeer::translateFieldName(Ezer_PropelStepInstancePeer::TYPE, BasePeer::TYPE_COLNAME, BasePeer::TYPE_NUM);
		$results = array();
		
		// populate the object(s)
		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key = Ezer_PropelStepInstancePeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj = Ezer_PropelStepInstancePeer::getInstanceFromPool($key))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://propel.phpdb.org/trac/ticket/509
				// $obj->hydrate($row, 0, true); // rehydrate
				$results[] = $obj;
			} else {
				$type = $row[$typePosition];
				$obj = self::newStep($type);
				$obj->hydrate($row);
				$results[] = $obj;
				Ezer_PropelStepInstancePeer::addInstanceToPool($obj, $key);
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
				return new Ezer_PropelBusinessProcessInstance();
		
			case Ezer_IntStep::STEP_TYPE_SCOPE:
				return new Ezer_PropelScopeInstance();
		
			case Ezer_IntStep::STEP_TYPE_FLOW:
				return new Ezer_PropelFlowInstance();
		
			case Ezer_IntStep::STEP_TYPE_SEQUENCE:
				return new Ezer_PropelSequenceInstance();
		
			case Ezer_IntStep::STEP_TYPE_ACTIVITY:
				return new Ezer_PropelActivityStepInstance();
		
			case Ezer_IntStep::STEP_TYPE_ASSIGN:
				return new Ezer_PropelAssignStepInstance();
		
			case Ezer_IntStep::STEP_TYPE_IF:
				return new Ezer_PropelIfInstance();
			
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
	 * Retrieve all active child steps
	 *
	 * @param      PropelPDO $con the connection to use
	 * @return     array<Ezer_PropelStepInstance>
	 */
	public static function retrieveChildSteps($containerId, $containerType, PropelPDO $con = null)
	{
		$criteria = new Criteria();
		$criteria->add(Ezer_PropelStepInstancePeer::CONTAINER_INSTANCE_ID, $containerId);
		$criteria->add(Ezer_PropelStepInstancePeer::CONTAINER_INSTANCE_TYPE, $containerType);

		return self::doSelect($criteria, $con);
	}
	
} // Ezer_PropelStepInstancePeer
