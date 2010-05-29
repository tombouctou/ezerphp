
<?php
require_once dirname(__FILE__) . '/WsBpel_TActivity.class.php';

// Genarated by Ezer_XsdClasses
// 

/**
 * @author Tan-Tan
 * @package Schema
 * @subpackage Types.wsbpel
 */
class WsBpel_TPhp extends WsBpel_TActivity
{
	private $correlations = null;
	private $partnerLink = null;
	private $portType = null;
	private $operation = null;
	private $variable = null;
	private $createInstance = null;


	public function getCorrelations()
	{
		return $this->correlations;
	}
	public function setCorrelations(WsBpel_TCorrelations $correlations)
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
	

	public function getCreateInstance()
	{
		return $this->createInstance;
	}
	public function setCreateInstance(WsBpel_TBoolean $createInstance)
	{
		$this->createInstance = $createInstance;
	}
	
}

?>
		