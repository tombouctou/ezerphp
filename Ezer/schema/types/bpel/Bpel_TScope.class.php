
<?php
require_once dirname(__FILE__) . '/Bpel_TActivity.class.php';

// Genarated by Ezer_XsdClasses
// 

/**
 * @author Tan-Tan
 * @package Schema
 * @subpackage Types.bpel
 */
class Bpel_TScope extends Bpel_TActivity
{
	private $variables = null;
	private $correlationSets = null;
	private $faultHandlers = null;
	private $compensationHandler = null;
	private $eventHandlers = null;
	private $variableAccessSerializable = null;
	private $arr_activity = array();


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
	

	public function getVariableAccessSerializable()
	{
		return $this->variableAccessSerializable;
	}
	public function setVariableAccessSerializable(Bpel_TBoolean $variableAccessSerializable)
	{
		$this->variableAccessSerializable = $variableAccessSerializable;
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
		