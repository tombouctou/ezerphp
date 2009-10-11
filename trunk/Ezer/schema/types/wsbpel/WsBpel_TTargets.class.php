
<?php
require_once dirname(__FILE__) . '/WsBpel_TExtensibleElements.class.php';

// Genarated by Ezer_XsdClasses
// 

/**
 * @author Tan-Tan
 * @package Schema
 * @subpackage Types.wsbpel
 */
class WsBpel_TTargets extends WsBpel_TExtensibleElements
{
	private $joinCondition = null;
	private $target = null;


	public function getJoinCondition()
	{
		return $this->joinCondition;
	}
	public function setJoinCondition($joinCondition)
	{
		$this->joinCondition = $joinCondition;
	}
	

	public function getTarget()
	{
		return $this->target;
	}
	public function setTarget($target)
	{
		$this->target = $target;
	}
	
}

?>
		