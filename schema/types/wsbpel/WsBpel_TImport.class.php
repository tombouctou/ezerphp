
<?php
require_once dirname(__FILE__) . '/WsBpel_TExtensibleElements.class.php';

// Genarated by Ezer_XsdClasses
// 

/**
 * @author Tan-Tan
 * @package Schema
 * @subpackage Types.wsbpel
 */
class WsBpel_TImport extends WsBpel_TExtensibleElements
{
	private $namespace = null;
	private $location = null;
	private $importType = null;


	public function getNamespace()
	{
		return $this->namespace;
	}
	public function setNamespace(WsBpel_AnyURI $namespace)
	{
		$this->namespace = $namespace;
	}
	

	public function getLocation()
	{
		return $this->location;
	}
	public function setLocation(WsBpel_AnyURI $location)
	{
		$this->location = $location;
	}
	

	public function getImportType()
	{
		return $this->importType;
	}
	public function setImportType(WsBpel_AnyURI $importType)
	{
		$this->importType = $importType;
	}
	
}

?>
		