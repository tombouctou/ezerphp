
<?php
require_once dirname(__FILE__) . '/WsBpel_TActivity.class.php';

// Genarated by Ezer_XsdClasses
// 

/**
 * @author Tan-Tan
 * @package Schema
 * @subpackage Types.wsbpel
 */
class WsBpel_TFlow extends WsBpel_TActivity
{
	private $links = null;
	private $arr_activity = array();


	public function getLinks()
	{
		return $this->links;
	}
	public function setLinks($links)
	{
		$this->links = $links;
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
		