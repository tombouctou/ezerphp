
<?php
require_once dirname(__FILE__) . '/Bpel_TActivity.class.php';

// Genarated by Ezer_XsdClasses
// 

/**
 * @author Tan-Tan
 * @package Schema
 * @subpackage Types.bpel
 */
class Bpel_TSequence extends Bpel_TActivity
{
	private $arr_activity = array();


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
		