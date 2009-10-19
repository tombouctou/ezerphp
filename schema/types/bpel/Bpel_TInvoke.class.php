
<?php
require_once dirname(__FILE__) . '/Bpel_TActivity.class.php';

// Genarated by Ezer_XsdClasses
// 

/**
 * @author Tan-Tan
 * @package Schema
 * @subpackage Types.bpel
 */
class Bpel_TInvoke extends Bpel_TActivity
{
	private $correlations = null;
	private $catch = null;
	private $catchAll = null;
	private $compensationHandler = null;
	private $partnerLink = null;
	private $portType = null;
	private $operation = null;
	private $inputVariable = null;
	private $outputVariable = null;


	public function getCorrelations()
	{
		return $this->correlations;
	}
	public function setCorrelations(Bpel_TCorrelationsWithPattern $correlations)
	{
		$this->correlations = $correlations;
	}
	

	public function getCatch()
	{
		return $this->catch;
	}
	public function setCatch(Bpel_TCatch $catch)
	{
		$this->catch = $catch;
	}
	

	public function getCatchAll()
	{
		return $this->catchAll;
	}
	public function setCatchAll(Bpel_TActivityOrCompensateContainer $catchAll)
	{
		$this->catchAll = $catchAll;
	}
	

	public function getCompensationHandler()
	{
		return $this->compensationHandler;
	}
	public function setCompensationHandler(Bpel_TCompensationHandler $compensationHandler)
	{
		$this->compensationHandler = $compensationHandler;
	}
	

	public function getPartnerLink()
	{
		return $this->partnerLink;
	}
	public function setPartnerLink($partnerLink)
	{
		$this->partnerLink = $partnerLink;
	}
	

	public function getPortType()
	{
		return $this->portType;
	}
	public function setPortType($portType)
	{
		$this->portType = $portType;
	}
	

	public function getOperation()
	{
		return $this->operation;
	}
	public function setOperation($operation)
	{
		$this->operation = $operation;
	}
	

	public function getInputVariable()
	{
		return $this->inputVariable;
	}
	public function setInputVariable($inputVariable)
	{
		$this->inputVariable = $inputVariable;
	}
	

	public function getOutputVariable()
	{
		return $this->outputVariable;
	}
	public function setOutputVariable($outputVariable)
	{
		$this->outputVariable = $outputVariable;
	}
	
}

?>
		