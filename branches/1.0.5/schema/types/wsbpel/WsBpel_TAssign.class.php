
<?php
require_once dirname(__FILE__) . '/WsBpel_TActivity.class.php';

// Genarated by Ezer_XsdClasses
// 

/**
 * @author Tan-Tan
 * @package Schema
 * @subpackage Types.wsbpel
 */
class WsBpel_TAssign extends WsBpel_TActivity
{
	private $copy = null;
	private $extensionAssignOperation = null;
	private $validate = null;


	public function getCopy()
	{
		return $this->copy;
	}
	public function setCopy($copy)
	{
		$this->copy = $copy;
	}
	

	public function getExtensionAssignOperation()
	{
		return $this->extensionAssignOperation;
	}
	public function setExtensionAssignOperation($extensionAssignOperation)
	{
		$this->extensionAssignOperation = $extensionAssignOperation;
	}
	

	public function getValidate()
	{
		return $this->validate;
	}
	public function setValidate(WsBpel_TBoolean $validate)
	{
		$this->validate = $validate;
	}
	
}

?>
		