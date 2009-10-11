
<?php
require_once dirname(__FILE__) . '/Bpel_TActivity.class.php';

// Genarated by Ezer_XsdClasses
// 

/**
 * @author Tan-Tan
 * @package Schema
 * @subpackage Types.bpel
 */
class Bpel_TWhile extends Bpel_TActivity
{
	private $condition = null;
	private $arr_activity = array();


	public function getCondition()
	{
		return $this->condition;
	}
	public function setCondition(Bpel_TBoolean_expr $condition)
	{
		$this->condition = $condition;
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
		