<?php


/**
 * @package    lib.model.data
 */
class Ezer_PropelCaseData extends Ezer_PropelData 
{
	/**
	 * @var array
	 */
	protected $variables = array();
	
	/**
	 * @return array
	 */
	public function getVariables()
	{
		return $this->variables;
	}
	
	/**
	 * @param array $variables
	 */
	
	public function setVariables(array $variables)
	{
		$this->variables = $variables;
	}
}
