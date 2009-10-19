
<?php
require_once dirname(__FILE__) . '/WsBpel_TActivityContainer.class.php';

// Genarated by Ezer_XsdClasses
// 

/**
 * @author Tan-Tan
 * @package Schema
 * @subpackage Types.wsbpel
 */
class WsBpel_TCatch extends WsBpel_TActivityContainer
{
	private $faultName = null;
	private $faultVariable = null;
	private $faultMessageType = null;
	private $faultElement = null;


	public function getFaultName()
	{
		return $this->faultName;
	}
	public function setFaultName(WsBpel_QName $faultName)
	{
		$this->faultName = $faultName;
	}
	

	public function getFaultVariable()
	{
		return $this->faultVariable;
	}
	public function setFaultVariable(WsBpel_BPELVariableName $faultVariable)
	{
		$this->faultVariable = $faultVariable;
	}
	

	public function getFaultMessageType()
	{
		return $this->faultMessageType;
	}
	public function setFaultMessageType(WsBpel_QName $faultMessageType)
	{
		$this->faultMessageType = $faultMessageType;
	}
	

	public function getFaultElement()
	{
		return $this->faultElement;
	}
	public function setFaultElement(WsBpel_QName $faultElement)
	{
		$this->faultElement = $faultElement;
	}
	
}

?>
		