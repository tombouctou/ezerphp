
<?php
require_once dirname(__FILE__) . '/Bpel_TActivity.class.php';

// Genarated by Ezer_XsdClasses
// 

/**
 * @author Tan-Tan
 * @package Schema
 * @subpackage Types.bpel
 */
class Bpel_TThrow extends Bpel_TActivity
{
	private $faultName = null;
	private $faultVariable = null;


	public function getFaultName()
	{
		return $this->faultName;
	}
	public function setFaultName($faultName)
	{
		$this->faultName = $faultName;
	}
	

	public function getFaultVariable()
	{
		return $this->faultVariable;
	}
	public function setFaultVariable($faultVariable)
	{
		$this->faultVariable = $faultVariable;
	}
	
}

?>
		