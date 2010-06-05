<?php


/**
 * @package    lib.model.data
 */
class Ezer_PropelScopeData extends Ezer_PropelData 
{
	/**
	 * @var array<Ezer_Variable>
	 */
	protected $variables = array();
	
	/**
	 * @return array<Ezer_Variable>
	 */
	public function getVariables()
	{
		return $this->variables;
	}
	
	/**
	 * @param Ezer_Variable $variable
	 */
	public function addVariable(Ezer_Variable $variable)
	{
		$this->variables[] = $variable;
	}
}
