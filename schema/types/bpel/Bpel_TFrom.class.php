
<?php
require_once dirname(__FILE__) . '/Bpel_TExtensibleElements.class.php';

// Genarated by Ezer_XsdClasses
// 

/**
 * @author Tan-Tan
 * @package Schema
 * @subpackage Types.bpel
 */
class Bpel_TFrom extends Bpel_TExtensibleElements
{
	private $variable = null;
	private $part = null;
	private $query = null;
	private $property = null;
	private $partnerLink = null;
	private $endpointReference = null;
	private $expression = null;
	private $opaque = null;


	public function getVariable()
	{
		return $this->variable;
	}
	public function setVariable($variable)
	{
		$this->variable = $variable;
	}
	

	public function getPart()
	{
		return $this->part;
	}
	public function setPart($part)
	{
		$this->part = $part;
	}
	

	public function getQuery()
	{
		return $this->query;
	}
	public function setQuery(Bpel_String $query)
	{
		$this->query = $query;
	}
	

	public function getProperty()
	{
		return $this->property;
	}
	public function setProperty($property)
	{
		$this->property = $property;
	}
	

	public function getPartnerLink()
	{
		return $this->partnerLink;
	}
	public function setPartnerLink($partnerLink)
	{
		$this->partnerLink = $partnerLink;
	}
	

	public function getEndpointReference()
	{
		return $this->endpointReference;
	}
	public function setEndpointReference(Bpel_TRoles $endpointReference)
	{
		$this->endpointReference = $endpointReference;
	}
	

	public function getExpression()
	{
		return $this->expression;
	}
	public function setExpression(Bpel_String $expression)
	{
		$this->expression = $expression;
	}
	

	public function getOpaque()
	{
		return $this->opaque;
	}
	public function setOpaque(Bpel_TBoolean $opaque)
	{
		$this->opaque = $opaque;
	}
	
}

?>
		