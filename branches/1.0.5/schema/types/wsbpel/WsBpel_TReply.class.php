
<?php
require_once dirname(__FILE__) . '/WsBpel_TActivity.class.php';

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
class WsBpel_TReply extends WsBpel_TActivity
{
	private $correlations = null;
	private $toParts = null;
	private $partnerLink = null;
	private $portType = null;
	private $operation = null;
	private $variable = null;
	private $faultName = null;
	private $messageExchange = null;


	public function getCorrelations()
	{
		return $this->correlations;
	}
	public function setCorrelations(WsBpel_TCorrelations $correlations)
	{
		$this->correlations = $correlations;
	}
	

	public function getToParts()
	{
		return $this->toParts;
	}
	public function setToParts($toParts)
	{
		$this->toParts = $toParts;
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
	

	public function getVariable()
	{
		return $this->variable;
	}
	public function setVariable(WsBpel_BPELVariableName $variable)
	{
		$this->variable = $variable;
	}
	

	public function getFaultName()
	{
		return $this->faultName;
	}
	public function setFaultName(WsBpel_QName $faultName)
	{
		$this->faultName = $faultName;
	}
	

	public function getMessageExchange()
	{
		return $this->messageExchange;
	}
	public function setMessageExchange(WsBpel_NCName $messageExchange)
	{
		$this->messageExchange = $messageExchange;
	}
	
}

?>
		