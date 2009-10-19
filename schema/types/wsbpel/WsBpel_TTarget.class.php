
<?php
require_once dirname(__FILE__) . '/WsBpel_TExtensibleElements.class.php';

// Genarated by Ezer_XsdClasses
// 

/**
 * @author Tan-Tan
 * @package Schema
 * @subpackage Types.wsbpel
 */
class WsBpel_TTarget extends WsBpel_TExtensibleElements
{
	private $linkName = null;


	public function getLinkName()
	{
		return $this->linkName;
	}
	public function setLinkName(WsBpel_NCName $linkName)
	{
		$this->linkName = $linkName;
	}
	
}

?>
		