
<?php


// Genarated by Ezer_XsdClasses
// 

/**
 * @author Tan-Tan
 * @package Schema
 * @subpackage Types.wsbpel
 */
class WsBpel_TTo 
{
	private $documentation = null;
	private $query = null;
	private $opaque = null;
	private $expressionLanguage = null;
	private $variable = null;
	private $part = null;
	private $property = null;
	private $partnerLink = null;


	public function getDocumentation()
	{
		return $this->documentation;
	}
	public function setDocumentation($documentation)
	{
		$this->documentation = $documentation;
	}
	

	public function getQuery()
	{
		return $this->query;
	}
	public function setQuery($query)
	{
		$this->query = $query;
	}
	

	public function getOpaque()
	{
		return $this->opaque;
	}
	public function setOpaque(WsBpel_TOpaqueBoolean $opaque)
	{
		$this->opaque = $opaque;
	}
	

	public function getExpressionLanguage()
	{
		return $this->expressionLanguage;
	}
	public function setExpressionLanguage(WsBpel_AnyURI $expressionLanguage)
	{
		$this->expressionLanguage = $expressionLanguage;
	}
	

	public function getVariable()
	{
		return $this->variable;
	}
	public function setVariable(WsBpel_BPELVariableName $variable)
	{
		$this->variable = $variable;
	}
	

	public function getPart()
	{
		return $this->part;
	}
	public function setPart(WsBpel_NCName $part)
	{
		$this->part = $part;
	}
	

	public function getProperty()
	{
		return $this->property;
	}
	public function setProperty(WsBpel_QName $property)
	{
		$this->property = $property;
	}
	

	public function getPartnerLink()
	{
		return $this->partnerLink;
	}
	public function setPartnerLink(WsBpel_NCName $partnerLink)
	{
		$this->partnerLink = $partnerLink;
	}
	
}

?>
		