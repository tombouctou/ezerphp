
<?php
require_once dirname(__FILE__) . '/Bpel_TExtensibleElements.class.php';

// Genarated by Ezer_XsdClasses
// 

/**
 * @author Tan-Tan
 * @package Schema
 * @subpackage Types.bpel
 */
class Bpel_TLinks extends Bpel_TExtensibleElements
{
	private $link = null;


	public function getLink()
	{
		return $this->link;
	}
	public function setLink(Bpel_TLink $link)
	{
		$this->link = $link;
	}
	
}

?>
		