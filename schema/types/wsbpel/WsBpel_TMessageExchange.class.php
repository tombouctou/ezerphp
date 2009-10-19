
<?php
require_once dirname(__FILE__) . '/WsBpel_TExtensibleElements.class.php';

// Genarated by Ezer_XsdClasses
// 

/**
 * @author Tan-Tan
 * @package Schema
 * @subpackage Types.wsbpel
 */
class WsBpel_TMessageExchange extends WsBpel_TExtensibleElements
{
	private $name = null;


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
		