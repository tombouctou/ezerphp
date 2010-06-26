<?php


/**
 * @package    lib.model.data
 */
class Ezer_PropelForeachData extends Ezer_PropelData 
{
	/**
	 * @var int paralell or serial
	 */
	protected $order_type;
	
	/**
	 * @var Ezer_AssignStepFromAttribute items array arg name
	 */
	protected $arg;
	
	/**
	 * @param int $order_type paralell or serial
	 */
	public function setOrderType($order_type)
	{
		$this->order_type = $order_type;
	}
	
	/**
	 * @param Ezer_AssignStepFromAttribute $arg items array arg name
	 */
	public function setArg(Ezer_AssignStepFromAttribute $arg)
	{
		$this->arg = $arg;
	}
	
	/**
	 * @return Ezer_AssignStepFromAttribute items array argument name
	 */
	public function getArg()
	{
		return $this->arg;
	}
	
	/**
	 * @return int paralell or serial
	 */
	public function getOrderType()
	{
		return $this->order_type;
	}
}
