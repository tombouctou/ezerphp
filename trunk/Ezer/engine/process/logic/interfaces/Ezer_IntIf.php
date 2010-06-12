<?php
interface Ezer_IntIf extends Ezer_IntStepContainer
{
	/**
	 * @param string $condition php code
	 */
	public function setCondition($condition);
	
	/**
	 * @return string $condition php code
	 */
	public function getCondition();
}