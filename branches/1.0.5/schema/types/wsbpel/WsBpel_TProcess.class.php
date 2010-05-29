
<?php
require_once dirname(__FILE__) . '/WsBpel_TExtensibleElements.class.php';

// Genarated by Ezer_XsdClasses
// 

/**
 * @author Tan-Tan
 * @package Schema
 * @subpackage Types.wsbpel
 */
class WsBpel_TProcess extends WsBpel_TExtensibleElements
{
	private $extensions = null;
	private $import = null;
	private $partnerLinks = null;
	private $messageExchanges = null;
	private $variables = null;
	private $correlationSets = null;
	private $faultHandlers = null;
	private $eventHandlers = null;
	private $name = null;
	private $targetNamespace = null;
	private $queryLanguage = null;
	private $expressionLanguage = null;
	private $suppressJoinFailure = null;
	private $exitOnStandardFault = null;
	private $abstractProcessProfile = null;
	private $arr_activity = array();


	public function getExtensions()
	{
		return $this->extensions;
	}
	public function setExtensions($extensions)
	{
		$this->extensions = $extensions;
	}
	

	public function getImport()
	{
		return $this->import;
	}
	public function setImport($import)
	{
		$this->import = $import;
	}
	

	public function getPartnerLinks()
	{
		return $this->partnerLinks;
	}
	public function setPartnerLinks($partnerLinks)
	{
		$this->partnerLinks = $partnerLinks;
	}
	

	public function getMessageExchanges()
	{
		return $this->messageExchanges;
	}
	public function setMessageExchanges($messageExchanges)
	{
		$this->messageExchanges = $messageExchanges;
	}
	

	public function getVariables()
	{
		return $this->variables;
	}
	public function setVariables($variables)
	{
		$this->variables = $variables;
	}
	

	public function getCorrelationSets()
	{
		return $this->correlationSets;
	}
	public function setCorrelationSets($correlationSets)
	{
		$this->correlationSets = $correlationSets;
	}
	

	public function getFaultHandlers()
	{
		return $this->faultHandlers;
	}
	public function setFaultHandlers($faultHandlers)
	{
		$this->faultHandlers = $faultHandlers;
	}
	

	public function getEventHandlers()
	{
		return $this->eventHandlers;
	}
	public function setEventHandlers($eventHandlers)
	{
		$this->eventHandlers = $eventHandlers;
	}
	

	public function getName()
	{
		return $this->name;
	}
	public function setName(WsBpel_NCName $name)
	{
		$this->name = $name;
	}
	

	public function getTargetNamespace()
	{
		return $this->targetNamespace;
	}
	public function setTargetNamespace(WsBpel_AnyURI $targetNamespace)
	{
		$this->targetNamespace = $targetNamespace;
	}
	

	public function getQueryLanguage()
	{
		return $this->queryLanguage;
	}
	public function setQueryLanguage(WsBpel_AnyURI $queryLanguage)
	{
		$this->queryLanguage = $queryLanguage;
	}
	

	public function getExpressionLanguage()
	{
		return $this->expressionLanguage;
	}
	public function setExpressionLanguage(WsBpel_AnyURI $expressionLanguage)
	{
		$this->expressionLanguage = $expressionLanguage;
	}
	

	public function getSuppressJoinFailure()
	{
		return $this->suppressJoinFailure;
	}
	public function setSuppressJoinFailure(WsBpel_TBoolean $suppressJoinFailure)
	{
		$this->suppressJoinFailure = $suppressJoinFailure;
	}
	

	public function getExitOnStandardFault()
	{
		return $this->exitOnStandardFault;
	}
	public function setExitOnStandardFault(WsBpel_TBoolean $exitOnStandardFault)
	{
		$this->exitOnStandardFault = $exitOnStandardFault;
	}
	

	public function getAbstractProcessProfile()
	{
		return $this->abstractProcessProfile;
	}
	public function setAbstractProcessProfile(WsBpel_AnyURI $abstractProcessProfile)
	{
		$this->abstractProcessProfile = $abstractProcessProfile;
	}
	

	public function get()
	{
		return $this->arr_activity;
	}
	public function addActivity(WsBpel_Activity $activity)
	{
		$this->arr_activity[] = $activity;
	}
	
}

?>
		