
<?php
require_once dirname(__FILE__) . '/WsBpel_TExtensibleElements.class.php';

// Genarated by Ezer_XsdClasses
// 

/**
 * @author Tan-Tan
 * @package Schema
 * @subpackage Types.wsbpel
 */
class WsBpel_TToPart extends WsBpel_TExtensibleElements
{
	private $part = null;
	private $fromVariable = null;


	public function getPart()
	{
		return $this->part;
	}
	public function setPart(WsBpel_NCName $part)
	{
		$this->part = $part;
	}
	

	public function getFromVariable()
	{
		return $this->fromVariable;
	}
	public function setFromVariable(WsBpel_BPELVariableName $fromVariable)
	{
		$this->fromVariable = $fromVariable;
	}
	
}

?>
		