
<?php
require_once dirname(__FILE__) . '/WsBpel_TActivity.class.php';

// Genarated by Ezer_XsdClasses
// 
// 
// 			
// 				XSD Authors: The child element correlations needs to be a Local Element Declaration, 
// 				because there is another correlations element defined for the non-invoke activities.
// 			
// 		

/**
 * @author Tan-Tan
 * @package Schema
 * @subpackage Types.wsbpel
 */
class WsBpel_TInvoke extends WsBpel_TActivity
{
	private $correlations = null;
	private $catch = null;
	private $catchAll = null;
	private $compensationHandler = null;
	private $toParts = null;
	private $fromParts = null;
	private $partnerLink = null;
	private $portType = null;
	private $operation = null;
	private $inputVariable = null;
	private $outputVariable = null;


	public function getCorrelations()
	{
		return $this->correlations;
	}
	public function setCorrelations(WsBpel_TCorrelationsWithPattern $correlations)
	{
		$this->correlations = $correlations;
	}
	

	public function getCatch()
	{
		return $this->catch;
	}
	public function setCatch($catch)
	{
		$this->catch = $catch;
	}
	

	public function getCatchAll()
	{
		return $this->catchAll;
	}
	public function setCatchAll($catchAll)
	{
		$this->catchAll = $catchAll;
	}
	

	public function getCompensationHandler()
	{
		return $this->compensationHandler;
	}
	public function setCompensationHandler($compensationHandler)
	{
		$this->compensationHandler = $compensationHandler;
	}
	

	public function getToParts()
	{
		return $this->toParts;
	}
	public function setToParts($toParts)
	{
		$this->toParts = $toParts;
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
	

	public function getInputVariable()
	{
		return $this->inputVariable;
	}
	public function setInputVariable(WsBpel_BPELVariableName $inputVariable)
	{
		$this->inputVariable = $inputVariable;
	}
	

	public function getOutputVariable()
	{
		return $this->outputVariable;
	}
	public function setOutputVariable(WsBpel_BPELVariableName $outputVariable)
	{
		$this->outputVariable = $outputVariable;
	}
	
}

?>
		