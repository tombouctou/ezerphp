
<?php
require_once dirname(__FILE__) . '/Bpel_TExtensibleDocumented.class.php';

// Genarated by Ezer_XsdClasses
// 

/**
 * @author Tan-Tan
 * @package Schema
 * @subpackage Types.bpel
 */
class Bpel_TDefinitions extends Bpel_TExtensibleDocumented
{
	private $targetNamespace = null;
	private $name = null;
	private $arr_anyTopLevelOptionalElement = array();


	public function getTargetNamespace()
	{
		return $this->targetNamespace;
	}
	public function setTargetNamespace(Bpel_AnyURI $targetNamespace)
	{
		$this->targetNamespace = $targetNamespace;
	}
	

	public function getName()
	{
		return $this->name;
	}
	public function setName(Bpel_NCName $name)
	{
		$this->name = $name;
	}
	

	public function get()
	{
		return $this->arr_anyTopLevelOptionalElement;
	}
	public function addAnyTopLevelOptionalElement(Bpel_AnyTopLevelOptionalElement $anyTopLevelOptionalElement)
	{
		$this->arr_anyTopLevelOptionalElement[] = $anyTopLevelOptionalElement;
	}
	
}

?>
		