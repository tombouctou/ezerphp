<?php

/**
 * Base static class for performing query and update operations on the 'bp_step_instances' table.
 *
 * 
 *
 * @package    lib.model.om
 */
abstract class BaseEzer_PropelStepInstancePeer {

	/** the default database name for this class */
	const DATABASE_NAME = 'ezer';

	/** the table name for this class */
	const TABLE_NAME = 'bp_step_instances';

	/** the related Propel class for this table */
	const OM_CLASS = 'Ezer_PropelStepInstance';

	/** A class that can be returned by this peer. */
	const CLASS_DEFAULT = 'lib.model.Ezer_PropelStepInstance';

	/** the related TableMap class for this table */
	const TM_CLASS = 'Ezer_PropelStepInstanceTableMap';
	
	/** The total number of columns. */
	const NUM_COLUMNS = 11;

	/** The number of lazy-loaded columns. */
	const NUM_LAZY_LOAD_COLUMNS = 0;

	/** the column name for the ID field */
	const ID = 'bp_step_instances.ID';

	/** the column name for the PROCESS_ID field */
	const PROCESS_ID = 'bp_step_instances.PROCESS_ID';

	/** the column name for the CASE_ID field */
	const CASE_ID = 'bp_step_instances.CASE_ID';

	/** the column name for the STEP_ID field */
	const STEP_ID = 'bp_step_instances.STEP_ID';

	/** the column name for the NAME field */
	const NAME = 'bp_step_instances.NAME';

	/** the column name for the TYPE field */
	const TYPE = 'bp_step_instances.TYPE';

	/** the column name for the CONTAINER_INSTANCE_ID field */
	const CONTAINER_INSTANCE_ID = 'bp_step_instances.CONTAINER_INSTANCE_ID';

	/** the column name for the CONTAINER_INSTANCE_TYPE field */
	const CONTAINER_INSTANCE_TYPE = 'bp_step_instances.CONTAINER_INSTANCE_TYPE';

	/** the column name for the PRIORITY field */
	const PRIORITY = 'bp_step_instances.PRIORITY';

	/** the column name for the STATUS field */
	const STATUS = 'bp_step_instances.STATUS';

	/** the column name for the DATA field */
	const DATA = 'bp_step_instances.DATA';

	/**
	 * An identiy map to hold any loaded instances of Ezer_PropelStepInstance objects.
	 * This must be public so that other peer classes can access this when hydrating from JOIN
	 * queries.
	 * @var        array Ezer_PropelStepInstance[]
	 */
	public static $instances = array();


	/**
	 * holds an array of fieldnames
	 *
	 * first dimension keys are the type constants
	 * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
	 */
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'ProcessId', 'CaseId', 'StepId', 'Name', 'Type', 'ContainerInstanceId', 'ContainerInstanceType', 'Priority', 'Status', 'Data', ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('id', 'processId', 'caseId', 'stepId', 'name', 'type', 'containerInstanceId', 'containerInstanceType', 'priority', 'status', 'data', ),
		BasePeer::TYPE_COLNAME => array (self::ID, self::PROCESS_ID, self::CASE_ID, self::STEP_ID, self::NAME, self::TYPE, self::CONTAINER_INSTANCE_ID, self::CONTAINER_INSTANCE_TYPE, self::PRIORITY, self::STATUS, self::DATA, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'process_id', 'case_id', 'step_id', 'name', 'type', 'container_instance_id', 'container_instance_type', 'priority', 'status', 'data', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, )
	);

	/**
	 * holds an array of keys for quick access to the fieldnames array
	 *
	 * first dimension keys are the type constants
	 * e.g. self::$fieldNames[BasePeer::TYPE_PHPNAME]['Id'] = 0
	 */
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'ProcessId' => 1, 'CaseId' => 2, 'StepId' => 3, 'Name' => 4, 'Type' => 5, 'ContainerInstanceId' => 6, 'ContainerInstanceType' => 7, 'Priority' => 8, 'Status' => 9, 'Data' => 10, ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('id' => 0, 'processId' => 1, 'caseId' => 2, 'stepId' => 3, 'name' => 4, 'type' => 5, 'containerInstanceId' => 6, 'containerInstanceType' => 7, 'priority' => 8, 'status' => 9, 'data' => 10, ),
		BasePeer::TYPE_COLNAME => array (self::ID => 0, self::PROCESS_ID => 1, self::CASE_ID => 2, self::STEP_ID => 3, self::NAME => 4, self::TYPE => 5, self::CONTAINER_INSTANCE_ID => 6, self::CONTAINER_INSTANCE_TYPE => 7, self::PRIORITY => 8, self::STATUS => 9, self::DATA => 10, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'process_id' => 1, 'case_id' => 2, 'step_id' => 3, 'name' => 4, 'type' => 5, 'container_instance_id' => 6, 'container_instance_type' => 7, 'priority' => 8, 'status' => 9, 'data' => 10, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, )
	);

	/**
	 * Translates a fieldname to another type
	 *
	 * @param      string $name field name
	 * @param      string $fromType One of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
	 *                         BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM
	 * @param      string $toType   One of the class type constants
	 * @return     string translated name of the field.
	 * @throws     PropelException - if the specified name could not be found in the fieldname mappings.
	 */
	static public function translateFieldName($name, $fromType, $toType)
	{
		$toNames = self::getFieldNames($toType);
		$key = isset(self::$fieldKeys[$fromType][$name]) ? self::$fieldKeys[$fromType][$name] : null;
		if ($key === null) {
			throw new PropelException("'$name' could not be found in the field names of type '$fromType'. These are: " . print_r(self::$fieldKeys[$fromType], true));
		}
		return $toNames[$key];
	}

	/**
	 * Returns an array of field names.
	 *
	 * @param      string $type The type of fieldnames to return:
	 *                      One of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
	 *                      BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM
	 * @return     array A list of field names
	 */

	static public function getFieldNames($type = BasePeer::TYPE_PHPNAME)
	{
		if (!array_key_exists($type, self::$fieldNames)) {
			throw new PropelException('Method getFieldNames() expects the parameter $type to be one of the class constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME, BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM. ' . $type . ' was given.');
		}
		return self::$fieldNames[$type];
	}

	/**
	 * Convenience method which changes table.column to alias.column.
	 *
	 * Using this method you can maintain SQL abstraction while using column aliases.
	 * <code>
	 *		$c->addAlias("alias1", TablePeer::TABLE_NAME);
	 *		$c->addJoin(TablePeer::alias("alias1", TablePeer::PRIMARY_KEY_COLUMN), TablePeer::PRIMARY_KEY_COLUMN);
	 * </code>
	 * @param      string $alias The alias for the current table.
	 * @param      string $column The column name for current table. (i.e. Ezer_PropelStepInstancePeer::COLUMN_NAME).
	 * @return     string
	 */
	public static function alias($alias, $column)
	{
		return str_replace(Ezer_PropelStepInstancePeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	/**
	 * Add all the columns needed to create a new object.
	 *
	 * Note: any columns that were marked with lazyLoad="true" in the
	 * XML schema will not be added to the select list and only loaded
	 * on demand.
	 *
	 * @param      criteria object containing the columns to add.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function addSelectColumns(Criteria $criteria)
	{
		$criteria->addSelectColumn(Ezer_PropelStepInstancePeer::ID);
		$criteria->addSelectColumn(Ezer_PropelStepInstancePeer::PROCESS_ID);
		$criteria->addSelectColumn(Ezer_PropelStepInstancePeer::CASE_ID);
		$criteria->addSelectColumn(Ezer_PropelStepInstancePeer::STEP_ID);
		$criteria->addSelectColumn(Ezer_PropelStepInstancePeer::NAME);
		$criteria->addSelectColumn(Ezer_PropelStepInstancePeer::TYPE);
		$criteria->addSelectColumn(Ezer_PropelStepInstancePeer::CONTAINER_INSTANCE_ID);
		$criteria->addSelectColumn(Ezer_PropelStepInstancePeer::CONTAINER_INSTANCE_TYPE);
		$criteria->addSelectColumn(Ezer_PropelStepInstancePeer::PRIORITY);
		$criteria->addSelectColumn(Ezer_PropelStepInstancePeer::STATUS);
		$criteria->addSelectColumn(Ezer_PropelStepInstancePeer::DATA);
	}

	/**
	 * Returns the number of rows matching criteria.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
	 * @param      PropelPDO $con
	 * @return     int Number of matching rows.
	 */
	public static function doCount(Criteria $criteria, $distinct = false, PropelPDO $con = null)
	{
		// we may modify criteria, so copy it first
		$criteria = clone $criteria;

		// We need to set the primary table name, since in the case that there are no WHERE columns
		// it will be impossible for the BasePeer::createSelectSql() method to determine which
		// tables go into the FROM clause.
		$criteria->setPrimaryTableName(Ezer_PropelStepInstancePeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			Ezer_PropelStepInstancePeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count
		$criteria->setDbName(self::DATABASE_NAME); // Set the correct dbName

		if ($con === null) {
			$con = Propel::getConnection(Ezer_PropelStepInstancePeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
		// BasePeer returns a PDOStatement
		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; // no rows returned; we infer that means 0 matches.
		}
		$stmt->closeCursor();
		return $count;
	}
	/**
	 * Method to select one object from the DB.
	 *
	 * @param      Criteria $criteria object used to create the SELECT statement.
	 * @param      PropelPDO $con
	 * @return     Ezer_PropelStepInstance
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectOne(Criteria $criteria, PropelPDO $con = null)
	{
		$critcopy = clone $criteria;
		$critcopy->setLimit(1);
		$objects = Ezer_PropelStepInstancePeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	/**
	 * Method to do selects.
	 *
	 * @param      Criteria $criteria The Criteria object used to build the SELECT statement.
	 * @param      PropelPDO $con
	 * @return     array Array of selected Objects
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelect(Criteria $criteria, PropelPDO $con = null)
	{
		return Ezer_PropelStepInstancePeer::populateObjects(Ezer_PropelStepInstancePeer::doSelectStmt($criteria, $con));
	}
	/**
	 * Prepares the Criteria object and uses the parent doSelect() method to execute a PDOStatement.
	 *
	 * Use this method directly if you want to work with an executed statement durirectly (for example
	 * to perform your own object hydration).
	 *
	 * @param      Criteria $criteria The Criteria object used to build the SELECT statement.
	 * @param      PropelPDO $con The connection to use
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 * @return     PDOStatement The executed PDOStatement object.
	 * @see        BasePeer::doSelect()
	 */
	public static function doSelectStmt(Criteria $criteria, PropelPDO $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(Ezer_PropelStepInstancePeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		if (!$criteria->hasSelectClause()) {
			$criteria = clone $criteria;
			Ezer_PropelStepInstancePeer::addSelectColumns($criteria);
		}

		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		// BasePeer returns a PDOStatement
		return BasePeer::doSelect($criteria, $con);
	}
	/**
	 * Adds an object to the instance pool.
	 *
	 * Propel keeps cached copies of objects in an instance pool when they are retrieved
	 * from the database.  In some cases -- especially when you override doSelect*()
	 * methods in your stub classes -- you may need to explicitly add objects
	 * to the cache in order to ensure that the same objects are always returned by doSelect*()
	 * and retrieveByPK*() calls.
	 *
	 * @param      Ezer_PropelStepInstance $value A Ezer_PropelStepInstance object.
	 * @param      string $key (optional) key to use for instance map (for performance boost if key was already calculated externally).
	 */
	public static function addInstanceToPool(Ezer_PropelStepInstance $obj, $key = null)
	{
		if (Propel::isInstancePoolingEnabled()) {
			if ($key === null) {
				$key = (string) $obj->getId();
			} // if key === null
			self::$instances[$key] = $obj;
		}
	}

	/**
	 * Removes an object from the instance pool.
	 *
	 * Propel keeps cached copies of objects in an instance pool when they are retrieved
	 * from the database.  In some cases -- especially when you override doDelete
	 * methods in your stub classes -- you may need to explicitly remove objects
	 * from the cache in order to prevent returning objects that no longer exist.
	 *
	 * @param      mixed $value A Ezer_PropelStepInstance object or a primary key value.
	 */
	public static function removeInstanceFromPool($value)
	{
		if (Propel::isInstancePoolingEnabled() && $value !== null) {
			if (is_object($value) && $value instanceof Ezer_PropelStepInstance) {
				$key = (string) $value->getId();
			} elseif (is_scalar($value)) {
				// assume we've been passed a primary key
				$key = (string) $value;
			} else {
				$e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or Ezer_PropelStepInstance object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value,true)));
				throw $e;
			}

			unset(self::$instances[$key]);
		}
	} // removeInstanceFromPool()

	/**
	 * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
	 *
	 * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
	 * a multi-column primary key, a serialize()d version of the primary key will be returned.
	 *
	 * @param      string $key The key (@see getPrimaryKeyHash()) for this instance.
	 * @return     Ezer_PropelStepInstance Found object or NULL if 1) no instance exists for specified key or 2) instance pooling has been disabled.
	 * @see        getPrimaryKeyHash()
	 */
	public static function getInstanceFromPool($key)
	{
		if (Propel::isInstancePoolingEnabled()) {
			if (isset(self::$instances[$key])) {
				return self::$instances[$key];
			}
		}
		return null; // just to be explicit
	}
	
	/**
	 * Clear the instance pool.
	 *
	 * @return     void
	 */
	public static function clearInstancePool()
	{
		self::$instances = array();
	}
	
	/**
	 * Method to invalidate the instance pool of all tables related to bp_step_instances
	 * by a foreign key with ON DELETE CASCADE
	 */
	public static function clearRelatedInstancePool()
	{
	}

	/**
	 * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
	 *
	 * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
	 * a multi-column primary key, a serialize()d version of the primary key will be returned.
	 *
	 * @param      array $row PropelPDO resultset row.
	 * @param      int $startcol The 0-based offset for reading from the resultset row.
	 * @return     string A string version of PK or NULL if the components of primary key in result array are all null.
	 */
	public static function getPrimaryKeyHashFromRow($row, $startcol = 0)
	{
		// If the PK cannot be derived from the row, return NULL.
		if ($row[$startcol] === null) {
			return null;
		}
		return (string) $row[$startcol];
	}

	/**
	 * The returned array will contain objects of the default type or
	 * objects that inherit from the default.
	 *
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function populateObjects(PDOStatement $stmt)
	{
		$results = array();
	
		// set the class once to avoid overhead in the loop
		$cls = Ezer_PropelStepInstancePeer::getOMClass(false);
		// populate the object(s)
		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key = Ezer_PropelStepInstancePeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj = Ezer_PropelStepInstancePeer::getInstanceFromPool($key))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://propel.phpdb.org/trac/ticket/509
				// $obj->hydrate($row, 0, true); // rehydrate
				$results[] = $obj;
			} else {
				$obj = new $cls();
				$obj->hydrate($row);
				$results[] = $obj;
				Ezer_PropelStepInstancePeer::addInstanceToPool($obj, $key);
			} // if key exists
		}
		$stmt->closeCursor();
		return $results;
	}
	/**
	 * Returns the TableMap related to this peer.
	 * This method is not needed for general use but a specific application could have a need.
	 * @return     TableMap
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function getTableMap()
	{
		return Propel::getDatabaseMap(self::DATABASE_NAME)->getTable(self::TABLE_NAME);
	}

	/**
	 * Add a TableMap instance to the database for this peer class.
	 */
	public static function buildTableMap()
	{
	  $dbMap = Propel::getDatabaseMap(BaseEzer_PropelStepInstancePeer::DATABASE_NAME);
	  if (!$dbMap->hasTable(BaseEzer_PropelStepInstancePeer::TABLE_NAME))
	  {
	    $dbMap->addTableObject(new Ezer_PropelStepInstanceTableMap());
	  }
	}

	/**
	 * The class that the Peer will make instances of.
	 *
	 * If $withPrefix is true, the returned path
	 * uses a dot-path notation which is tranalted into a path
	 * relative to a location on the PHP include_path.
	 * (e.g. path.to.MyClass -> 'path/to/MyClass.php')
	 *
	 * @param      boolean  Whether or not to return the path wit hthe class name 
	 * @return     string path.to.ClassName
	 */
	public static function getOMClass($withPrefix = true)
	{
		return $withPrefix ? Ezer_PropelStepInstancePeer::CLASS_DEFAULT : Ezer_PropelStepInstancePeer::OM_CLASS;
	}

	/**
	 * Method perform an INSERT on the database, given a Ezer_PropelStepInstance or Criteria object.
	 *
	 * @param      mixed $values Criteria or Ezer_PropelStepInstance object containing data that is used to create the INSERT statement.
	 * @param      PropelPDO $con the PropelPDO connection to use
	 * @return     mixed The new primary key.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doInsert($values, PropelPDO $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(Ezer_PropelStepInstancePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; // rename for clarity
		} else {
			$criteria = $values->buildCriteria(); // build Criteria from Ezer_PropelStepInstance object
		}

		if ($criteria->containsKey(Ezer_PropelStepInstancePeer::ID) && $criteria->keyContainsValue(Ezer_PropelStepInstancePeer::ID) ) {
			throw new PropelException('Cannot insert a value for auto-increment primary key ('.Ezer_PropelStepInstancePeer::ID.')');
		}


		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		try {
			// use transaction because $criteria could contain info
			// for more than one table (I guess, conceivably)
			$con->beginTransaction();
			$pk = BasePeer::doInsert($criteria, $con);
			$con->commit();
		} catch(PropelException $e) {
			$con->rollBack();
			throw $e;
		}

		return $pk;
	}

	/**
	 * Method perform an UPDATE on the database, given a Ezer_PropelStepInstance or Criteria object.
	 *
	 * @param      mixed $values Criteria or Ezer_PropelStepInstance object containing data that is used to create the UPDATE statement.
	 * @param      PropelPDO $con The connection to use (specify PropelPDO connection object to exert more control over transactions).
	 * @return     int The number of affected rows (if supported by underlying database driver).
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doUpdate($values, PropelPDO $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(Ezer_PropelStepInstancePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$selectCriteria = new Criteria(self::DATABASE_NAME);

		if ($values instanceof Criteria) {
			$criteria = clone $values; // rename for clarity

			$comparison = $criteria->getComparison(Ezer_PropelStepInstancePeer::ID);
			$selectCriteria->add(Ezer_PropelStepInstancePeer::ID, $criteria->remove(Ezer_PropelStepInstancePeer::ID), $comparison);

		} else { // $values is Ezer_PropelStepInstance object
			$criteria = $values->buildCriteria(); // gets full criteria
			$selectCriteria = $values->buildPkeyCriteria(); // gets criteria w/ primary key(s)
		}

		// set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		return BasePeer::doUpdate($selectCriteria, $criteria, $con);
	}

	/**
	 * Method to DELETE all rows from the bp_step_instances table.
	 *
	 * @return     int The number of affected rows (if supported by underlying database driver).
	 */
	public static function doDeleteAll($con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(Ezer_PropelStepInstancePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		$affectedRows = 0; // initialize var to track total num of affected rows
		try {
			// use transaction because $criteria could contain info
			// for more than one table or we could emulating ON DELETE CASCADE, etc.
			$con->beginTransaction();
			$affectedRows += BasePeer::doDeleteAll(Ezer_PropelStepInstancePeer::TABLE_NAME, $con);
			// Because this db requires some delete cascade/set null emulation, we have to
			// clear the cached instance *after* the emulation has happened (since
			// instances get re-added by the select statement contained therein).
			Ezer_PropelStepInstancePeer::clearInstancePool();
			Ezer_PropelStepInstancePeer::clearRelatedInstancePool();
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	}

	/**
	 * Method perform a DELETE on the database, given a Ezer_PropelStepInstance or Criteria object OR a primary key value.
	 *
	 * @param      mixed $values Criteria or Ezer_PropelStepInstance object or primary key or array of primary keys
	 *              which is used to create the DELETE statement
	 * @param      PropelPDO $con the connection to use
	 * @return     int 	The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
	 *				if supported by native driver or if emulated using Propel.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	 public static function doDelete($values, PropelPDO $con = null)
	 {
		if ($con === null) {
			$con = Propel::getConnection(Ezer_PropelStepInstancePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
			// invalidate the cache for all objects of this type, since we have no
			// way of knowing (without running a query) what objects should be invalidated
			// from the cache based on this Criteria.
			Ezer_PropelStepInstancePeer::clearInstancePool();
			// rename for clarity
			$criteria = clone $values;
		} elseif ($values instanceof Ezer_PropelStepInstance) { // it's a model object
			// invalidate the cache for this single object
			Ezer_PropelStepInstancePeer::removeInstanceFromPool($values);
			// create criteria based on pk values
			$criteria = $values->buildPkeyCriteria();
		} else { // it's a primary key, or an array of pks
			$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(Ezer_PropelStepInstancePeer::ID, (array) $values, Criteria::IN);
			// invalidate the cache for this object(s)
			foreach ((array) $values as $singleval) {
				Ezer_PropelStepInstancePeer::removeInstanceFromPool($singleval);
			}
		}

		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		$affectedRows = 0; // initialize var to track total num of affected rows

		try {
			// use transaction because $criteria could contain info
			// for more than one table or we could emulating ON DELETE CASCADE, etc.
			$con->beginTransaction();
			
			$affectedRows += BasePeer::doDelete($criteria, $con);
			Ezer_PropelStepInstancePeer::clearRelatedInstancePool();
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	}

	/**
	 * Validates all modified columns of given Ezer_PropelStepInstance object.
	 * If parameter $columns is either a single column name or an array of column names
	 * than only those columns are validated.
	 *
	 * NOTICE: This does not apply to primary or foreign keys for now.
	 *
	 * @param      Ezer_PropelStepInstance $obj The object to validate.
	 * @param      mixed $cols Column name or array of column names.
	 *
	 * @return     mixed TRUE if all columns are valid or the error message of the first invalid column.
	 */
	public static function doValidate(Ezer_PropelStepInstance $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(Ezer_PropelStepInstancePeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(Ezer_PropelStepInstancePeer::TABLE_NAME);

			if (! is_array($cols)) {
				$cols = array($cols);
			}

			foreach ($cols as $colName) {
				if ($tableMap->containsColumn($colName)) {
					$get = 'get' . $tableMap->getColumn($colName)->getPhpName();
					$columns[$colName] = $obj->$get();
				}
			}
		} else {

		}

		return BasePeer::doValidate(Ezer_PropelStepInstancePeer::DATABASE_NAME, Ezer_PropelStepInstancePeer::TABLE_NAME, $columns);
	}

	/**
	 * Retrieve a single object by pkey.
	 *
	 * @param      string $pk the primary key.
	 * @param      PropelPDO $con the connection to use
	 * @return     Ezer_PropelStepInstance
	 */
	public static function retrieveByPK($pk, PropelPDO $con = null)
	{

		if (null !== ($obj = Ezer_PropelStepInstancePeer::getInstanceFromPool((string) $pk))) {
			return $obj;
		}

		if ($con === null) {
			$con = Propel::getConnection(Ezer_PropelStepInstancePeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria = new Criteria(Ezer_PropelStepInstancePeer::DATABASE_NAME);
		$criteria->add(Ezer_PropelStepInstancePeer::ID, $pk);

		$v = Ezer_PropelStepInstancePeer::doSelect($criteria, $con);

		return !empty($v) > 0 ? $v[0] : null;
	}

	/**
	 * Retrieve multiple objects by pkey.
	 *
	 * @param      array $pks List of primary keys
	 * @param      PropelPDO $con the connection to use
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function retrieveByPKs($pks, PropelPDO $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(Ezer_PropelStepInstancePeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$objs = null;
		if (empty($pks)) {
			$objs = array();
		} else {
			$criteria = new Criteria(Ezer_PropelStepInstancePeer::DATABASE_NAME);
			$criteria->add(Ezer_PropelStepInstancePeer::ID, $pks, Criteria::IN);
			$objs = Ezer_PropelStepInstancePeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} // BaseEzer_PropelStepInstancePeer

// This is the static code needed to register the TableMap for this table with the main Propel class.
//
BaseEzer_PropelStepInstancePeer::buildTableMap();

