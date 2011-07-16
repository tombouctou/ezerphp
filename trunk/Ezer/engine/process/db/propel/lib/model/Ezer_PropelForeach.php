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
class Ezer_PropelForeach extends Ezer_PropelStepContainer implements Ezer_IntForeach 
{
	public function __construct()
	{
		parent::__construct();
		$this->dataObject = new Ezer_PropelForeachData();
		$this->setType(Ezer_IntStep::STEP_TYPE_FOREACH);
	}
	
	public function getCustomFields()
	{
		return array(
			'orderType',
			'arg',
		);
	}

	/**
	 * @param Ezer_ScopeInstance $scope_instance
	 * @return Ezer_PropelForeachInstance
	 */
	public function &createInstance(Ezer_ScopeInstance $scope_instance)
	{
		$ret = new Ezer_PropelForeachInstance();
		$ret->setContainer($scope_instance);
		$ret->setStepId($this->getId());
		$ret->setName($this->getName());
		$ret->save();
		
		return $ret;
	}
	
	/**
	 * @param int $order_type paralell or serial
	 */
	public function setOrderType($order_type)
	{
		$this->dataObject->setOrderType($order_type);
	}
	
	/**
	 * @param Ezer_AssignStepFromAttribute $arg items array arg name
	 */
	public function setArg(Ezer_AssignStepFromAttribute $arg)
	{
		$this->dataObject->setArg($arg);
	}
	
	/**
	 * @return Ezer_AssignStepFromAttribute items array argument name
	 */
	public function getArg()
	{
		return $this->dataObject->getArg();
	}
	
	
	/**
	 * @return int paralell or serial
	 */
	public function getOrderType()
	{
		return $this->dataObject->getOrderType();
	}
}
