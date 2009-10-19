
<?php
require_once dirname(__FILE__) . '/Bpel_TActivity.class.php';

// Genarated by Ezer_XsdClasses
// 

/**
 * @author Tan-Tan
 * @package Schema
 * @subpackage Types.bpel
 */
class Bpel_TFlow extends Bpel_TActivity
{
	private $links = null;
	private $arr_activity = array();


	public function getLinks()
	{
		return $this->links;
	}
	public function setLinks(Bpel_TLinks $links)
	{
		$this->links = $links;
	}
	

	public function get()
	{
		return $this->arr_activity;
	}
	public function addActivity(Bpel_Activity $activity)
	{
		$this->arr_activity[] = $activity;
	}
	
}

?>
		