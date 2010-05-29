
<?php
require_once dirname(__FILE__) . '/WsBpel_TExtensibleElements.class.php';

// Genarated by Ezer_XsdClasses
// 

/**
 * @author Tan-Tan
 * @package Schema
 * @subpackage Types.wsbpel
 */
class WsBpel_TCompletionCondition extends WsBpel_TExtensibleElements
{
	private $branches = null;


	public function getBranches()
	{
		return $this->branches;
	}
	public function setBranches($branches)
	{
		$this->branches = $branches;
	}
	
}

?>
		