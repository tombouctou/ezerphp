
<?php
require_once dirname(__FILE__) . '/WsBpel_TActivity.class.php';

// Genarated by Ezer_XsdClasses
// 

/**
 * @author Tan-Tan
 * @package Schema
 * @subpackage Types.wsbpel
 */
class WsBpel_TIf extends WsBpel_TActivity
{
	private $condition = null;
	private $elseif = null;
	private $else = null;
	private $arr_activity = array();


	public function getCondition()
	{
		return $this->condition;
	}
	public function setCondition($condition)
	{
		$this->condition = $condition;
	}
	

	public function getElseif()
	{
		return $this->elseif;
	}
	public function setElseif($elseif)
	{
		$this->elseif = $elseif;
	}
	

	public function getElse()
	{
		return $this->else;
	}
	public function setElse($else)
	{
		$this->else = $else;
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
		