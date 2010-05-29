
<?php
require_once dirname(__FILE__) . '/WsBpel_TActivity.class.php';

// Genarated by Ezer_XsdClasses
// 
// 
// 			
// 				There is no schema-level default for "exitOnStandardFault"
// 				at "scope". Because, it will inherit default from enclosing scope
// 				or process.
// 			
// 		

/**
 * @author Tan-Tan
 * @package Schema
 * @subpackage Types.wsbpel
 */
class WsBpel_TScope extends WsBpel_TActivity
{
	private $partnerLinks = null;
	private $messageExchanges = null;
	private $variables = null;
	private $correlationSets = null;
	private $faultHandlers = null;
	private $compensationHandler = null;
	private $terminationHandler = null;
	private $eventHandlers = null;
	private $isolated = null;
	private $exitOnStandardFault = null;
	private $arr_activity = array();


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
	

	public function getCompensationHandler()
	{
		return $this->compensationHandler;
	}
	public function setCompensationHandler($compensationHandler)
	{
		$this->compensationHandler = $compensationHandler;
	}
	

	public function getTerminationHandler()
	{
		return $this->terminationHandler;
	}
	public function setTerminationHandler($terminationHandler)
	{
		$this->terminationHandler = $terminationHandler;
	}
	

	public function getEventHandlers()
	{
		return $this->eventHandlers;
	}
	public function setEventHandlers($eventHandlers)
	{
		$this->eventHandlers = $eventHandlers;
	}
	

	public function getIsolated()
	{
		return $this->isolated;
	}
	public function setIsolated(WsBpel_TBoolean $isolated)
	{
		$this->isolated = $isolated;
	}
	

	public function getExitOnStandardFault()
	{
		return $this->exitOnStandardFault;
	}
	public function setExitOnStandardFault(WsBpel_TBoolean $exitOnStandardFault)
	{
		$this->exitOnStandardFault = $exitOnStandardFault;
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
		