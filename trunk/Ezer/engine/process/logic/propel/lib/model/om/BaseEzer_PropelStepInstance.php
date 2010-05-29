<?php

/**
 * Base class that represents a row from the 'bp_step_instances' table.
 *
 * 
 *
 * @package    lib.model.om
 */
abstract class BaseEzer_PropelStepInstance extends BaseObject  implements Persistent {


	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        Ezer_PropelStepInstancePeer
	 */
	protected static $peer;

	/**
	 * The value for the id field.
	 * @var        string
	 */
	protected $id;

	/**
	 * The value for the process_id field.
	 * @var        string
	 */
	protected $process_id;

	/**
	 * The value for the case_id field.
	 * @var        string
	 */
	protected $case_id;

	/**
	 * The value for the step_id field.
	 * @var        string
	 */
	protected $step_id;

	/**
	 * The value for the name field.
	 * @var        string
	 */
	protected $name;

	/**
	 * The value for the type field.
	 * @var        string
	 */
	protected $type;

	/**
	 * The value for the container_instance_id field.
	 * @var        string
	 */
	protected $container_instance_id;

	/**
	 * The value for the container_instance_type field.
	 * @var        int
	 */
	protected $container_instance_type;

	/**
	 * The value for the priority field.
	 * @var        int
	 */
	protected $priority;

	/**
	 * The value for the status field.
	 * @var        int
	 */
	protected $status;

	/**
	 * The value for the data field.
	 * @var        string
	 */
	protected $data;

	/**
	 * Flag to prevent endless save loop, if this object is referenced
	 * by another object which falls in this transaction.
	 * @var        boolean
	 */
	protected $alreadyInSave = false;

	/**
	 * Flag to prevent endless validation loop, if this object is referenced
	 * by another object which falls in this transaction.
	 * @var        boolean
	 */
	protected $alreadyInValidation = false;

	/**
	 * Get the [id] column value.
	 * 
	 * @return     string
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 * Get the [process_id] column value.
	 * 
	 * @return     string
	 */
	public function getProcessId()
	{
		return $this->process_id;
	}

	/**
	 * Get the [case_id] column value.
	 * 
	 * @return     string
	 */
	public function getCaseId()
	{
		return $this->case_id;
	}

	/**
	 * Get the [step_id] column value.
	 * 
	 * @return     string
	 */
	public function getStepId()
	{
		return $this->step_id;
	}

	/**
	 * Get the [name] column value.
	 * 
	 * @return     string
	 */
	public function getName()
	{
		return $this->name;
	}

	/**
	 * Get the [type] column value.
	 * 
	 * @return     string
	 */
	public function getType()
	{
		return $this->type;
	}

	/**
	 * Get the [container_instance_id] column value.
	 * 
	 * @return     string
	 */
	public function getContainerInstanceId()
	{
		return $this->container_instance_id;
	}

	/**
	 * Get the [container_instance_type] column value.
	 * 
	 * @return     int
	 */
	public function getContainerInstanceType()
	{
		return $this->container_instance_type;
	}

	/**
	 * Get the [priority] column value.
	 * 
	 * @return     int
	 */
	public function getPriority()
	{
		return $this->priority;
	}

	/**
	 * Get the [status] column value.
	 * 
	 * @return     int
	 */
	public function getStatus()
	{
		return $this->status;
	}

	/**
	 * Get the [data] column value.
	 * 
	 * @return     string
	 */
	public function getData()
	{
		return $this->data;
	}

	/**
	 * Set the value of [id] column.
	 * 
	 * @param      string $v new value
	 * @return     Ezer_PropelStepInstance The current object (for fluent API support)
	 */
	public function setId($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = Ezer_PropelStepInstancePeer::ID;
		}

		return $this;
	} // setId()

	/**
	 * Set the value of [process_id] column.
	 * 
	 * @param      string $v new value
	 * @return     Ezer_PropelStepInstance The current object (for fluent API support)
	 */
	public function setProcessId($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->process_id !== $v) {
			$this->process_id = $v;
			$this->modifiedColumns[] = Ezer_PropelStepInstancePeer::PROCESS_ID;
		}

		return $this;
	} // setProcessId()

	/**
	 * Set the value of [case_id] column.
	 * 
	 * @param      string $v new value
	 * @return     Ezer_PropelStepInstance The current object (for fluent API support)
	 */
	public function setCaseId($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->case_id !== $v) {
			$this->case_id = $v;
			$this->modifiedColumns[] = Ezer_PropelStepInstancePeer::CASE_ID;
		}

		return $this;
	} // setCaseId()

	/**
	 * Set the value of [step_id] column.
	 * 
	 * @param      string $v new value
	 * @return     Ezer_PropelStepInstance The current object (for fluent API support)
	 */
	public function setStepId($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->step_id !== $v) {
			$this->step_id = $v;
			$this->modifiedColumns[] = Ezer_PropelStepInstancePeer::STEP_ID;
		}

		return $this;
	} // setStepId()

	/**
	 * Set the value of [name] column.
	 * 
	 * @param      string $v new value
	 * @return     Ezer_PropelStepInstance The current object (for fluent API support)
	 */
	public function setName($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->name !== $v) {
			$this->name = $v;
			$this->modifiedColumns[] = Ezer_PropelStepInstancePeer::NAME;
		}

		return $this;
	} // setName()

	/**
	 * Set the value of [type] column.
	 * 
	 * @param      string $v new value
	 * @return     Ezer_PropelStepInstance The current object (for fluent API support)
	 */
	public function setType($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->type !== $v) {
			$this->type = $v;
			$this->modifiedColumns[] = Ezer_PropelStepInstancePeer::TYPE;
		}

		return $this;
	} // setType()

	/**
	 * Set the value of [container_instance_id] column.
	 * 
	 * @param      string $v new value
	 * @return     Ezer_PropelStepInstance The current object (for fluent API support)
	 */
	public function setContainerInstanceId($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->container_instance_id !== $v) {
			$this->container_instance_id = $v;
			$this->modifiedColumns[] = Ezer_PropelStepInstancePeer::CONTAINER_INSTANCE_ID;
		}

		return $this;
	} // setContainerInstanceId()

	/**
	 * Set the value of [container_instance_type] column.
	 * 
	 * @param      int $v new value
	 * @return     Ezer_PropelStepInstance The current object (for fluent API support)
	 */
	public function setContainerInstanceType($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->container_instance_type !== $v) {
			$this->container_instance_type = $v;
			$this->modifiedColumns[] = Ezer_PropelStepInstancePeer::CONTAINER_INSTANCE_TYPE;
		}

		return $this;
	} // setContainerInstanceType()

	/**
	 * Set the value of [priority] column.
	 * 
	 * @param      int $v new value
	 * @return     Ezer_PropelStepInstance The current object (for fluent API support)
	 */
	public function setPriority($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->priority !== $v) {
			$this->priority = $v;
			$this->modifiedColumns[] = Ezer_PropelStepInstancePeer::PRIORITY;
		}

		return $this;
	} // setPriority()

	/**
	 * Set the value of [status] column.
	 * 
	 * @param      int $v new value
	 * @return     Ezer_PropelStepInstance The current object (for fluent API support)
	 */
	public function setStatus($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->status !== $v) {
			$this->status = $v;
			$this->modifiedColumns[] = Ezer_PropelStepInstancePeer::STATUS;
		}

		return $this;
	} // setStatus()

	/**
	 * Set the value of [data] column.
	 * 
	 * @param      string $v new value
	 * @return     Ezer_PropelStepInstance The current object (for fluent API support)
	 */
	public function setData($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->data !== $v) {
			$this->data = $v;
			$this->modifiedColumns[] = Ezer_PropelStepInstancePeer::DATA;
		}

		return $this;
	} // setData()

	/**
	 * Indicates whether the columns in this object are only set to default values.
	 *
	 * This method can be used in conjunction with isModified() to indicate whether an object is both
	 * modified _and_ has some values set which are non-default.
	 *
	 * @return     boolean Whether the columns in this object are only been set with default values.
	 */
	public function hasOnlyDefaultValues()
	{
		// otherwise, everything was equal, so return TRUE
		return true;
	} // hasOnlyDefaultValues()

	/**
	 * Hydrates (populates) the object variables with values from the database resultset.
	 *
	 * An offset (0-based "start column") is specified so that objects can be hydrated
	 * with a subset of the columns in the resultset rows.  This is needed, for example,
	 * for results of JOIN queries where the resultset row includes columns from two or
	 * more tables.
	 *
	 * @param      array $row The row returned by PDOStatement->fetch(PDO::FETCH_NUM)
	 * @param      int $startcol 0-based offset column which indicates which restultset column to start with.
	 * @param      boolean $rehydrate Whether this object is being re-hydrated from the database.
	 * @return     int next starting column
	 * @throws     PropelException  - Any caught Exception will be rewrapped as a PropelException.
	 */
	public function hydrate($row, $startcol = 0, $rehydrate = false)
	{
		try {

			$this->id = ($row[$startcol + 0] !== null) ? (string) $row[$startcol + 0] : null;
			$this->process_id = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
			$this->case_id = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
			$this->step_id = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
			$this->name = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
			$this->type = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
			$this->container_instance_id = ($row[$startcol + 6] !== null) ? (string) $row[$startcol + 6] : null;
			$this->container_instance_type = ($row[$startcol + 7] !== null) ? (int) $row[$startcol + 7] : null;
			$this->priority = ($row[$startcol + 8] !== null) ? (int) $row[$startcol + 8] : null;
			$this->status = ($row[$startcol + 9] !== null) ? (int) $row[$startcol + 9] : null;
			$this->data = ($row[$startcol + 10] !== null) ? (string) $row[$startcol + 10] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

			// FIXME - using NUM_COLUMNS may be clearer.
			return $startcol + 11; // 11 = Ezer_PropelStepInstancePeer::NUM_COLUMNS - Ezer_PropelStepInstancePeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new PropelException("Error populating Ezer_PropelStepInstance object", $e);
		}
	}

	/**
	 * Checks and repairs the internal consistency of the object.
	 *
	 * This method is executed after an already-instantiated object is re-hydrated
	 * from the database.  It exists to check any foreign keys to make sure that
	 * the objects related to the current object are correct based on foreign key.
	 *
	 * You can override this method in the stub class, but you should always invoke
	 * the base method from the overridden method (i.e. parent::ensureConsistency()),
	 * in case your model changes.
	 *
	 * @throws     PropelException
	 */
	public function ensureConsistency()
	{

	} // ensureConsistency

	/**
	 * Reloads this object from datastore based on primary key and (optionally) resets all associated objects.
	 *
	 * This will only work if the object has been saved and has a valid primary key set.
	 *
	 * @param      boolean $deep (optional) Whether to also de-associated any related objects.
	 * @param      PropelPDO $con (optional) The PropelPDO connection to use.
	 * @return     void
	 * @throws     PropelException - if this object is deleted, unsaved or doesn't have pk match in db
	 */
	public function reload($deep = false, PropelPDO $con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("Cannot reload a deleted object.");
		}

		if ($this->isNew()) {
			throw new PropelException("Cannot reload an unsaved object.");
		}

		if ($con === null) {
			$con = Propel::getConnection(Ezer_PropelStepInstancePeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		// We don't need to alter the object instance pool; we're just modifying this instance
		// already in the pool.

		$stmt = Ezer_PropelStepInstancePeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); // rehydrate

		if ($deep) {  // also de-associate any related objects?

		} // if (deep)
	}

	/**
	 * Removes this object from datastore and sets delete attribute.
	 *
	 * @param      PropelPDO $con
	 * @return     void
	 * @throws     PropelException
	 * @see        BaseObject::setDeleted()
	 * @see        BaseObject::isDeleted()
	 */
	public function delete(PropelPDO $con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(Ezer_PropelStepInstancePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$ret = $this->preDelete($con);
			if ($ret) {
				Ezer_PropelStepInstancePeer::doDelete($this, $con);
				$this->postDelete($con);
				$this->setDeleted(true);
				$con->commit();
			} else {
				$con->commit();
			}
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	}

	/**
	 * Persists this object to the database.
	 *
	 * If the object is new, it inserts it; otherwise an update is performed.
	 * All modified related objects will also be persisted in the doSave()
	 * method.  This method wraps all precipitate database operations in a
	 * single transaction.
	 *
	 * @param      PropelPDO $con
	 * @return     int The number of rows affected by this insert/update and any referring fk objects' save() operations.
	 * @throws     PropelException
	 * @see        doSave()
	 */
	public function save(PropelPDO $con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(Ezer_PropelStepInstancePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		$isInsert = $this->isNew();
		try {
			$ret = $this->preSave($con);
			if ($isInsert) {
				$ret = $ret && $this->preInsert($con);
			} else {
				$ret = $ret && $this->preUpdate($con);
			}
			if ($ret) {
				$affectedRows = $this->doSave($con);
				if ($isInsert) {
					$this->postInsert($con);
				} else {
					$this->postUpdate($con);
				}
				$this->postSave($con);
				Ezer_PropelStepInstancePeer::addInstanceToPool($this);
			} else {
				$affectedRows = 0;
			}
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	}

	/**
	 * Performs the work of inserting or updating the row in the database.
	 *
	 * If the object is new, it inserts it; otherwise an update is performed.
	 * All related objects are also updated in this method.
	 *
	 * @param      PropelPDO $con
	 * @return     int The number of rows affected by this insert/update and any referring fk objects' save() operations.
	 * @throws     PropelException
	 * @see        save()
	 */
	protected function doSave(PropelPDO $con)
	{
		$affectedRows = 0; // initialize var to track total num of affected rows
		if (!$this->alreadyInSave) {
			$this->alreadyInSave = true;

			if ($this->isNew() ) {
				$this->modifiedColumns[] = Ezer_PropelStepInstancePeer::ID;
			}

			// If this object has been modified, then save it to the database.
			if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = Ezer_PropelStepInstancePeer::doInsert($this, $con);
					$affectedRows += 1; // we are assuming that there is only 1 row per doInsert() which
										 // should always be true here (even though technically
										 // BasePeer::doInsert() can insert multiple rows).

					$this->setId($pk);  //[IMV] update autoincrement primary key

					$this->setNew(false);
				} else {
					$affectedRows += Ezer_PropelStepInstancePeer::doUpdate($this, $con);
				}

				$this->resetModified(); // [HL] After being saved an object is no longer 'modified'
			}

			$this->alreadyInSave = false;

		}
		return $affectedRows;
	} // doSave()

	/**
	 * Array of ValidationFailed objects.
	 * @var        array ValidationFailed[]
	 */
	protected $validationFailures = array();

	/**
	 * Gets any ValidationFailed objects that resulted from last call to validate().
	 *
	 *
	 * @return     array ValidationFailed[]
	 * @see        validate()
	 */
	public function getValidationFailures()
	{
		return $this->validationFailures;
	}

	/**
	 * Validates the objects modified field values and all objects related to this table.
	 *
	 * If $columns is either a column name or an array of column names
	 * only those columns are validated.
	 *
	 * @param      mixed $columns Column name or an array of column names.
	 * @return     boolean Whether all columns pass validation.
	 * @see        doValidate()
	 * @see        getValidationFailures()
	 */
	public function validate($columns = null)
	{
		$res = $this->doValidate($columns);
		if ($res === true) {
			$this->validationFailures = array();
			return true;
		} else {
			$this->validationFailures = $res;
			return false;
		}
	}

	/**
	 * This function performs the validation work for complex object models.
	 *
	 * In addition to checking the current object, all related objects will
	 * also be validated.  If all pass then <code>true</code> is returned; otherwise
	 * an aggreagated array of ValidationFailed objects will be returned.
	 *
	 * @param      array $columns Array of column names to validate.
	 * @return     mixed <code>true</code> if all validations pass; array of <code>ValidationFailed</code> objets otherwise.
	 */
	protected function doValidate($columns = null)
	{
		if (!$this->alreadyInValidation) {
			$this->alreadyInValidation = true;
			$retval = null;

			$failureMap = array();


			if (($retval = Ezer_PropelStepInstancePeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(Ezer_PropelStepInstancePeer::DATABASE_NAME);

		if ($this->isColumnModified(Ezer_PropelStepInstancePeer::ID)) $criteria->add(Ezer_PropelStepInstancePeer::ID, $this->id);
		if ($this->isColumnModified(Ezer_PropelStepInstancePeer::PROCESS_ID)) $criteria->add(Ezer_PropelStepInstancePeer::PROCESS_ID, $this->process_id);
		if ($this->isColumnModified(Ezer_PropelStepInstancePeer::CASE_ID)) $criteria->add(Ezer_PropelStepInstancePeer::CASE_ID, $this->case_id);
		if ($this->isColumnModified(Ezer_PropelStepInstancePeer::STEP_ID)) $criteria->add(Ezer_PropelStepInstancePeer::STEP_ID, $this->step_id);
		if ($this->isColumnModified(Ezer_PropelStepInstancePeer::NAME)) $criteria->add(Ezer_PropelStepInstancePeer::NAME, $this->name);
		if ($this->isColumnModified(Ezer_PropelStepInstancePeer::TYPE)) $criteria->add(Ezer_PropelStepInstancePeer::TYPE, $this->type);
		if ($this->isColumnModified(Ezer_PropelStepInstancePeer::CONTAINER_INSTANCE_ID)) $criteria->add(Ezer_PropelStepInstancePeer::CONTAINER_INSTANCE_ID, $this->container_instance_id);
		if ($this->isColumnModified(Ezer_PropelStepInstancePeer::CONTAINER_INSTANCE_TYPE)) $criteria->add(Ezer_PropelStepInstancePeer::CONTAINER_INSTANCE_TYPE, $this->container_instance_type);
		if ($this->isColumnModified(Ezer_PropelStepInstancePeer::PRIORITY)) $criteria->add(Ezer_PropelStepInstancePeer::PRIORITY, $this->priority);
		if ($this->isColumnModified(Ezer_PropelStepInstancePeer::STATUS)) $criteria->add(Ezer_PropelStepInstancePeer::STATUS, $this->status);
		if ($this->isColumnModified(Ezer_PropelStepInstancePeer::DATA)) $criteria->add(Ezer_PropelStepInstancePeer::DATA, $this->data);

		return $criteria;
	}

	/**
	 * Builds a Criteria object containing the primary key for this object.
	 *
	 * Unlike buildCriteria() this method includes the primary key values regardless
	 * of whether or not they have been modified.
	 *
	 * @return     Criteria The Criteria object containing value(s) for primary key(s).
	 */
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(Ezer_PropelStepInstancePeer::DATABASE_NAME);

		$criteria->add(Ezer_PropelStepInstancePeer::ID, $this->id);

		return $criteria;
	}

	/**
	 * Returns the primary key for this object (row).
	 * @return     string
	 */
	public function getPrimaryKey()
	{
		return $this->getId();
	}

	/**
	 * Generic method to set the primary key (id column).
	 *
	 * @param      string $key Primary key.
	 * @return     void
	 */
	public function setPrimaryKey($key)
	{
		$this->setId($key);
	}

	/**
	 * Sets contents of passed object to values from current object.
	 *
	 * If desired, this method can also make copies of all associated (fkey referrers)
	 * objects.
	 *
	 * @param      object $copyObj An object of Ezer_PropelStepInstance (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setProcessId($this->process_id);

		$copyObj->setCaseId($this->case_id);

		$copyObj->setStepId($this->step_id);

		$copyObj->setName($this->name);

		$copyObj->setType($this->type);

		$copyObj->setContainerInstanceId($this->container_instance_id);

		$copyObj->setContainerInstanceType($this->container_instance_type);

		$copyObj->setPriority($this->priority);

		$copyObj->setStatus($this->status);

		$copyObj->setData($this->data);


		$copyObj->setNew(true);

		$copyObj->setId(NULL); // this is a auto-increment column, so set to default value

	}

	/**
	 * Makes a copy of this object that will be inserted as a new row in table when saved.
	 * It creates a new object filling in the simple attributes, but skipping any primary
	 * keys that are defined for the table.
	 *
	 * If desired, this method can also make copies of all associated (fkey referrers)
	 * objects.
	 *
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @return     Ezer_PropelStepInstance Clone of current object.
	 * @throws     PropelException
	 */
	public function copy($deepCopy = false)
	{
		// we use get_class(), because this might be a subclass
		$clazz = get_class($this);
		$copyObj = new $clazz();
		$this->copyInto($copyObj, $deepCopy);
		return $copyObj;
	}

	/**
	 * Returns a peer instance associated with this om.
	 *
	 * Since Peer classes are not to have any instance attributes, this method returns the
	 * same instance for all member of this class. The method could therefore
	 * be static, but this would prevent one from overriding the behavior.
	 *
	 * @return     Ezer_PropelStepInstancePeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new Ezer_PropelStepInstancePeer();
		}
		return self::$peer;
	}

	/**
	 * Resets all collections of referencing foreign keys.
	 *
	 * This method is a user-space workaround for PHP's inability to garbage collect objects
	 * with circular references.  This is currently necessary when using Propel in certain
	 * daemon or large-volumne/high-memory operations.
	 *
	 * @param      boolean $deep Whether to also clear the references on all associated objects.
	 */
	public function clearAllReferences($deep = false)
	{
		if ($deep) {
		} // if ($deep)

	}

} // BaseEzer_PropelStepInstance
