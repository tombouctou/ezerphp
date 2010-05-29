
<?php
require_once dirname(__FILE__) . '/WsBpel_TExtensibleElements.class.php';

// Genarated by Ezer_XsdClasses
// 

/**
 * @author Tan-Tan
 * @package Schema
 * @subpackage Types.wsbpel
 */
class WsBpel_TOnAlarmEvent extends WsBpel_TExtensibleElements
{
	private $repeatEvery = null;
	private $scope = null;
	private $arr_forOrUntilGroup = array();


	public function getRepeatEvery()
	{
		return $this->repeatEvery;
	}
	public function setRepeatEvery($repeatEvery)
	{
		$this->repeatEvery = $repeatEvery;
	}
	

	public function getScope()
	{
		return $this->scope;
	}
	public function setScope($scope)
	{
		$this->scope = $scope;
	}
	

	public function get()
	{
		return $this->arr_forOrUntilGroup;
	}
	public function addForOrUntilGroup(WsBpel_ForOrUntilGroup $forOrUntilGroup)
	{
		$this->arr_forOrUntilGroup[] = $forOrUntilGroup;
	}
	
}

?>
		