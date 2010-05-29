
<?php
require_once dirname(__FILE__) . '/Bpel_TExtensibleAttributesDocumented.class.php';

// Genarated by Ezer_XsdClasses
// 

/**
 * @author Tan-Tan
 * @package Schema
 * @subpackage Types.bpel
 */
class Bpel_TImport extends Bpel_TExtensibleAttributesDocumented
{
	private $namespace = null;
	private $location = null;


	public function getNamespace()
	{
		return $this->namespace;
	}
	public function setNamespace(Bpel_AnyURI $namespace)
	{
		$this->namespace = $namespace;
	}
	

	public function getLocation()
	{
		return $this->location;
	}
	public function setLocation(Bpel_AnyURI $location)
	{
		$this->location = $location;
	}
	
}

?>
		