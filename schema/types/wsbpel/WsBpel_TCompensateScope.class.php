
<?php
require_once dirname(__FILE__) . '/WsBpel_TActivity.class.php';

// Genarated by Ezer_XsdClasses
// 

/**
 * @author Tan-Tan
 * @package Schema
 * @subpackage Types.wsbpel
 */
class WsBpel_TCompensateScope extends WsBpel_TActivity
{
	private $target = null;


	public function getTarget()
	{
		return $this->target;
	}
	public function setTarget(WsBpel_NCName $target)
	{
		$this->target = $target;
	}
	
}

?>
		