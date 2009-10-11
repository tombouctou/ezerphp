
<?php
require_once dirname(__FILE__) . '/Bpel_TExtensibleElements.class.php';

// Genarated by Ezer_XsdClasses
// 

/**
 * @author Tan-Tan
 * @package Schema
 * @subpackage Types.bpel
 */
class Bpel_TOnMessage extends Bpel_TExtensibleElements
{
	private $correlations = null;
	private $partnerLink = null;
	private $portType = null;
	private $operation = null;
	private $variable = null;
	private $arr_activity = array();


	public function getCorrelations()
	{
		return $this->correlations;
	}
	public function setCorrelations(Bpel_TCorrelations $correlations)
	{
		$this->correlations = $correlations;
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
	

	public function getVariable()
	{
		return $this->variable;
	}
	public function setVariable($variable)
	{
		$this->variable = $variable;
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
		