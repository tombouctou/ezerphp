
<?php
require_once dirname(__FILE__) . '/WsBpel_TExtensibleElements.class.php';

// Genarated by Ezer_XsdClasses
// 

/**
 * @author Tan-Tan
 * @package Schema
 * @subpackage Types.wsbpel
 */
class WsBpel_TFromPart extends WsBpel_TExtensibleElements
{
	private $part = null;
	private $toVariable = null;


	public function getPart()
	{
		return $this->part;
	}
	public function setPart(WsBpel_NCName $part)
	{
		$this->part = $part;
	}
	

	public function getToVariable()
	{
		return $this->toVariable;
	}
	public function setToVariable(WsBpel_BPELVariableName $toVariable)
	{
		$this->toVariable = $toVariable;
	}
	
}

?>
		