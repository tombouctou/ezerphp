
<?php
require_once dirname(__FILE__) . '/WsBpel_TExtensibleElements.class.php';

// Genarated by Ezer_XsdClasses
// 

/**
 * @author Tan-Tan
 * @package Schema
 * @subpackage Types.wsbpel
 */
class WsBpel_TOnAlarmPick extends WsBpel_TExtensibleElements
{
	private $arr_forOrUntilGroup = array();
	private $arr_activity = array();


	public function get()
	{
		return $this->arr_forOrUntilGroup;
	}
	public function addForOrUntilGroup(WsBpel_ForOrUntilGroup $forOrUntilGroup)
	{
		$this->arr_forOrUntilGroup[] = $forOrUntilGroup;
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
		