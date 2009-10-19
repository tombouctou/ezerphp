
<?php
require_once dirname(__FILE__) . '/WsBpel_TExtensibleElements.class.php';

// Genarated by Ezer_XsdClasses
// 

/**
 * @author Tan-Tan
 * @package Schema
 * @subpackage Types.wsbpel
 */
class WsBpel_TExtension extends WsBpel_TExtensibleElements
{
	private $namespace = null;
	private $mustUnderstand = null;


	public function getNamespace()
	{
		return $this->namespace;
	}
	public function setNamespace(WsBpel_AnyURI $namespace)
	{
		$this->namespace = $namespace;
	}
	

	public function getMustUnderstand()
	{
		return $this->mustUnderstand;
	}
	public function setMustUnderstand(WsBpel_TBoolean $mustUnderstand)
	{
		$this->mustUnderstand = $mustUnderstand;
	}
	
}

?>
		