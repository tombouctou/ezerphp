
<?php
require_once dirname(__FILE__) . '/WsBpel_TExtensibleElements.class.php';

// Genarated by Ezer_XsdClasses
// 

/**
 * @author Tan-Tan
 * @package Schema
 * @subpackage Types.wsbpel
 */
class WsBpel_TCorrelation extends WsBpel_TExtensibleElements
{
	private $set = null;
	private $initiate = null;


	public function getSet()
	{
		return $this->set;
	}
	public function setSet(WsBpel_NCName $set)
	{
		$this->set = $set;
	}
	

	public function getInitiate()
	{
		return $this->initiate;
	}
	public function setInitiate(WsBpel_TInitiate $initiate)
	{
		$this->initiate = $initiate;
	}
	
}

?>
		