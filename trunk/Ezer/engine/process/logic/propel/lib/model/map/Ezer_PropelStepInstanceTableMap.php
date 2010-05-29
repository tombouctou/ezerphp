<?php


/**
 * This class defines the structure of the 'bp_step_instances' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    lib.model.map
 */
class Ezer_PropelStepInstanceTableMap extends TableMap {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.map.Ezer_PropelStepInstanceTableMap';

	/**
	 * Initialize the table attributes, columns and validators
	 * Relations are not initialized by this method since they are lazy loaded
	 *
	 * @return     void
	 * @throws     PropelException
	 */
	public function initialize()
	{
	  // attributes
		$this->setName('bp_step_instances');
		$this->setPhpName('Ezer_PropelStepInstance');
		$this->setClassname('Ezer_PropelStepInstance');
		$this->setPackage('lib.model');
		$this->setUseIdGenerator(true);
		// columns
		$this->addPrimaryKey('ID', 'Id', 'BIGINT', true, null, null);
		$this->addColumn('PROCESS_ID', 'ProcessId', 'BIGINT', true, null, null);
		$this->addColumn('CASE_ID', 'CaseId', 'BIGINT', true, null, null);
		$this->addColumn('STEP_ID', 'StepId', 'BIGINT', true, null, null);
		$this->addColumn('NAME', 'Name', 'VARCHAR', true, 27, null);
		$this->addColumn('TYPE', 'Type', 'VARCHAR', true, 27, null);
		$this->addColumn('CONTAINER_INSTANCE_ID', 'ContainerInstanceId', 'BIGINT', false, null, null);
		$this->addColumn('CONTAINER_INSTANCE_TYPE', 'ContainerInstanceType', 'SMALLINT', false, null, null);
		$this->addColumn('PRIORITY', 'Priority', 'SMALLINT', true, null, null);
		$this->addColumn('STATUS', 'Status', 'TINYINT', true, null, null);
		$this->addColumn('DATA', 'Data', 'CLOB', false, null, null);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
	} // buildRelations()

} // Ezer_PropelStepInstanceTableMap
