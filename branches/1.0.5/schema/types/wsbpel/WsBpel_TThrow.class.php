
<?php
require_once dirname(__FILE__) . '/WsBpel_TActivity.class.php';

// Genarated by Ezer_XsdClasses
// 

/**
 * @author Tan-Tan
 * @package Schema
 * @subpackage Types.wsbpel
 */
class WsBpel_TThrow extends WsBpel_TActivity
{
	private $faultName = null;
	private $faultVariable = null;


	public function getFaultName()
	{
		return $this->faultName;
	}
	public function setFaultName(WsBpel_QName $faultName)
	{
		$this->faultName = $faultName;
	}
	

	public function getFaultVariable()
	{
		return $this->faultVariable;
	}
	public function setFaultVariable(WsBpel_BPELVariableName $faultVariable)
	{
		$this->faultVariable = $faultVariable;
	}
	
}

?>
		