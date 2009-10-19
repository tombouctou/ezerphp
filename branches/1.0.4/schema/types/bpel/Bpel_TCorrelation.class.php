
<?php
require_once dirname(__FILE__) . '/Bpel_TExtensibleElements.class.php';

// Genarated by Ezer_XsdClasses
// 

/**
 * @author Tan-Tan
 * @package Schema
 * @subpackage Types.bpel
 */
class Bpel_TCorrelation extends Bpel_TExtensibleElements
{
	private $set = null;
	private $initiate = null;


	public function getSet()
	{
		return $this->set;
	}
	public function setSet($set)
	{
		$this->set = $set;
	}
	

	public function getInitiate()
	{
		return $this->initiate;
	}
	public function setInitiate(Bpel_TBoolean $initiate)
	{
		$this->initiate = $initiate;
	}
	
}

?>
		