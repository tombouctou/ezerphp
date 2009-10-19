
<?php
require_once dirname(__FILE__) . '/Bpel_TExtensibleElements.class.php';

// Genarated by Ezer_XsdClasses
// 

/**
 * @author Tan-Tan
 * @package Schema
 * @subpackage Types.bpel
 */
class Bpel_TVariables extends Bpel_TExtensibleElements
{
	private $variable = null;


	public function getVariable()
	{
		return $this->variable;
	}
	public function setVariable(Bpel_TVariable $variable)
	{
		$this->variable = $variable;
	}
	
}

?>
		