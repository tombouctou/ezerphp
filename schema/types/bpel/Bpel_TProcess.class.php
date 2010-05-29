
<?php
require_once dirname(__FILE__) . '/Bpel_TExtensibleElements.class.php';

// Genarated by Ezer_XsdClasses
// 

/**
 * @author Tan-Tan
 * @package Schema
 * @subpackage Types.bpel
 */
class Bpel_TProcess extends Bpel_TExtensibleElements
{
	private $partnerLinks = null;
	private $partners = null;
	private $variables = null;
	private $correlationSets = null;
	private $faultHandlers = null;
	private $compensationHandler = null;
	private $eventHandlers = null;
	private $name = null;
	private $targetNamespace = null;
	private $queryLanguage = null;
	private $expressionLanguage = null;
	private $suppressJoinFailure = null;
	private $enableInstanceCompensation = null;
	private $abstractProcess = null;
	private $arr_activity = array();


	public function getPartnerLinks()
	{
		return $this->partnerLinks;
	}
	public function setPartnerLinks(Bpel_TPartnerLinks $partnerLinks)
	{
		$this->partnerLinks = $partnerLinks;
	}
	

	public function getPartners()
	{
		return $this->partners;
	}
	public function setPartners(Bpel_TPartners $partners)
	{
		$this->partners = $partners;
	}
	

	public function getVariables()
	{
		return $this->variables;
	}
	public function setVariables(Bpel_TVariables $variables)
	{
		$this->variables = $variables;
	}
	

	public function getCorrelationSets()
	{
		return $this->correlationSets;
	}
	public function setCorrelationSets(Bpel_TCorrelationSets $correlationSets)
	{
		$this->correlationSets = $correlationSets;
	}
	

	public function getFaultHandlers()
	{
		return $this->faultHandlers;
	}
	public function setFaultHandlers(Bpel_TFaultHandlers $faultHandlers)
	{
		$this->faultHandlers = $faultHandlers;
	}
	

	public function getCompensationHandler()
	{
		return $this->compensationHandler;
	}
	public function setCompensationHandler(Bpel_TCompensationHandler $compensationHandler)
	{
		$this->compensationHandler = $compensationHandler;
	}
	

	public function getEventHandlers()
	{
		return $this->eventHandlers;
	}
	public function setEventHandlers(Bpel_TEventHandlers $eventHandlers)
	{
		$this->eventHandlers = $eventHandlers;
	}
	

	public function getName()
	{
		return $this->name;
	}
	public function setName($name)
	{
		$this->name = $name;
	}
	

	public function getTargetNamespace()
	{
		return $this->targetNamespace;
	}
	public function setTargetNamespace(Bpel_AnyURI $targetNamespace)
	{
		$this->targetNamespace = $targetNamespace;
	}
	

	public function getQueryLanguage()
	{
		return $this->queryLanguage;
	}
	public function setQueryLanguage(Bpel_AnyURI $queryLanguage)
	{
		$this->queryLanguage = $queryLanguage;
	}
	

	public function getExpressionLanguage()
	{
		return $this->expressionLanguage;
	}
	public function setExpressionLanguage(Bpel_AnyURI $expressionLanguage)
	{
		$this->expressionLanguage = $expressionLanguage;
	}
	

	public function getSuppressJoinFailure()
	{
		return $this->suppressJoinFailure;
	}
	public function setSuppressJoinFailure(Bpel_TBoolean $suppressJoinFailure)
	{
		$this->suppressJoinFailure = $suppressJoinFailure;
	}
	

	public function getEnableInstanceCompensation()
	{
		return $this->enableInstanceCompensation;
	}
	public function setEnableInstanceCompensation(Bpel_TBoolean $enableInstanceCompensation)
	{
		$this->enableInstanceCompensation = $enableInstanceCompensation;
	}
	

	public function getAbstractProcess()
	{
		return $this->abstractProcess;
	}
	public function setAbstractProcess(Bpel_TBoolean $abstractProcess)
	{
		$this->abstractProcess = $abstractProcess;
	}
	

	public function get()
	{
		return $this->arr_activity;
	}
	public function addActivity(Bpel_Activity $activity)
	{
		$this->arr_activity[] = $activity;
	}
	
}

?>
		