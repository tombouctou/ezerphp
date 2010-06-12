<?php


/**
 * @package    lib.model.data
 */
class Ezer_PropelIfData extends Ezer_PropelData
{
	/**
	 * @var string php code
	 */
	protected $condition;
	
	/**
	 * @param string $condition php code
	 */
	public function setCondition($condition)
	{
		$this->condition = $condition;
	}
	
	/**
	 * @return string $condition php code
	 */
	public function getCondition()
	{
		return $this->condition;
	}
}
