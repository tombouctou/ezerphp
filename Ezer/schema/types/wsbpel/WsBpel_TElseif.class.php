
<?php
require_once dirname(__FILE__) . '/WsBpel_TExtensibleElements.class.php';

// Genarated by Ezer_XsdClasses
// 

/**
 * @author Tan-Tan
 * @package Schema
 * @subpackage Types.wsbpel
 */
class WsBpel_TElseif extends WsBpel_TExtensibleElements
{
	private $condition = null;
	private $arr_activity = array();


	public function getCondition()
	{
		return $this->condition;
	}
	public function setCondition($condition)
	{
		$this->condition = $condition;
	}
	

	public function get()
	{
		return $this->arr_activity;
	}
	public function addActivity(WsBpel_Activity $activity)
	{
		$this->arr_activity[] = $activity;
	}
	
}

?>
		