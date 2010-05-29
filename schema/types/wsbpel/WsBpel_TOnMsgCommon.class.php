
<?php
require_once dirname(__FILE__) . '/WsBpel_TExtensibleElements.class.php';

// Genarated by Ezer_XsdClasses
// 
// 
// 			
// 				XSD Authors: The child element correlations needs to be a Local Element Declaration, 
// 				because there is another correlations element defined for the invoke activity.
// 			
// 		

/**
 * @author Tan-Tan
 * @package Schema
 * @subpackage Types.wsbpel
 */
class WsBpel_TOnMsgCommon extends WsBpel_TExtensibleElements
{
	private $correlations = null;
	private $fromParts = null;
	private $partnerLink = null;
	private $portType = null;
	private $operation = null;
	private $messageExchange = null;
	private $variable = null;


	public function getCorrelations()
	{
		return $this->correlations;
	}
	public function setCorrelations(WsBpel_TCorrelations $correlations)
	{
		$this->correlations = $correlations;
	}
	

	public function getFromParts()
	{
		return $this->fromParts;
	}
	public function setFromParts($fromParts)
	{
		$this->fromParts = $fromParts;
	}
	

	public function getPartnerLink()
	{
		return $this->partnerLink;
	}
	public function setPartnerLink(WsBpel_NCName $partnerLink)
	{
		$this->partnerLink = $partnerLink;
	}
	

	public function getPortType()
	{
		return $this->portType;
	}
	public function setPortType(WsBpel_QName $portType)
	{
		$this->portType = $portType;
	}
	

	public function getOperation()
	{
		return $this->operation;
	}
	public function setOperation(WsBpel_NCName $operation)
	{
		$this->operation = $operation;
	}
	

	public function getMessageExchange()
	{
		return $this->messageExchange;
	}
	public function setMessageExchange(WsBpel_NCName $messageExchange)
	{
		$this->messageExchange = $messageExchange;
	}
	

	public function getVariable()
	{
		return $this->variable;
	}
	public function setVariable(WsBpel_BPELVariableName $variable)
	{
		$this->variable = $variable;
	}
	
}

?>
		