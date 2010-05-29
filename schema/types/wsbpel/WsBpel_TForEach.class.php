
<?php
require_once dirname(__FILE__) . '/WsBpel_TActivity.class.php';

// Genarated by Ezer_XsdClasses
// 

/**
 * @author Tan-Tan
 * @package Schema
 * @subpackage Types.wsbpel
 */
class WsBpel_TForEach extends WsBpel_TActivity
{
	private $startCounterValue = null;
	private $finalCounterValue = null;
	private $completionCondition = null;
	private $scope = null;
	private $counterName = null;
	private $parallel = null;


	public function getStartCounterValue()
	{
		return $this->startCounterValue;
	}
	public function setStartCounterValue($startCounterValue)
	{
		$this->startCounterValue = $startCounterValue;
	}
	

	public function getFinalCounterValue()
	{
		return $this->finalCounterValue;
	}
	public function setFinalCounterValue($finalCounterValue)
	{
		$this->finalCounterValue = $finalCounterValue;
	}
	

	public function getCompletionCondition()
	{
		return $this->completionCondition;
	}
	public function setCompletionCondition($completionCondition)
	{
		$this->completionCondition = $completionCondition;
	}
	

	public function getScope()
	{
		return $this->scope;
	}
	public function setScope($scope)
	{
		$this->scope = $scope;
	}
	

	public function getCounterName()
	{
		return $this->counterName;
	}
	public function setCounterName(WsBpel_BPELVariableName $counterName)
	{
		$this->counterName = $counterName;
	}
	

	public function getParallel()
	{
		return $this->parallel;
	}
	public function setParallel(WsBpel_TBoolean $parallel)
	{
		$this->parallel = $parallel;
	}
	
}

?>
		