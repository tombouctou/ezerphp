<?php
interface Ezer_IntForeach extends Ezer_IntStepContainer
{
	const TYPE_PARALLEL = 1;
	const TYPE_SERIAL = 2;
	
	/**
	 * @param int $order_type paralell or serial
	 */
	public function setOrderType($order_type);
	
	/**
	 * @param Ezer_AssignStepFromAttribute $arg items array arg name
	 */
	public function setArg(Ezer_AssignStepFromAttribute $arg);
	
	/**
	 * @return Ezer_AssignStepFromAttribute items array argument name
	 */
	public function getArg();
	
	
	/**
	 * @return int paralell or serial
	 */
	public function getOrderType();
}