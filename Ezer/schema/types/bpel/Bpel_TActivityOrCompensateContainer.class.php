
<?php
require_once dirname(__FILE__) . '/Bpel_TExtensibleElements.class.php';

// Genarated by Ezer_XsdClasses
// 

/**
 * @author Tan-Tan
 * @package Schema
 * @subpackage Types.bpel
 */
class Bpel_TActivityOrCompensateContainer extends Bpel_TExtensibleElements
{
	private $compensate = null;
	private $arr_activity = array();


	public function getCompensate()
	{
		return $this->compensate;
	}
	public function setCompensate(Bpel_TCompensate $compensate)
	{
		$this->compensate = $compensate;
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
		