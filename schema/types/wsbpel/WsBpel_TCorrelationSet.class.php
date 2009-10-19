
<?php
require_once dirname(__FILE__) . '/WsBpel_TExtensibleElements.class.php';

// Genarated by Ezer_XsdClasses
// 

/**
 * @author Tan-Tan
 * @package Schema
 * @subpackage Types.wsbpel
 */
class WsBpel_TCorrelationSet extends WsBpel_TExtensibleElements
{
	private $properties = null;
	private $name = null;


	public function getProperties()
	{
		return $this->properties;
	}
	public function setProperties(WsBpel_QNames $properties)
	{
		$this->properties = $properties;
	}
	

	public function getName()
	{
		return $this->name;
	}
	public function setName(WsBpel_NCName $name)
	{
		$this->name = $name;
	}
	
}

?>
		