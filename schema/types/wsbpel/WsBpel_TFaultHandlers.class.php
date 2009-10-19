
<?php
require_once dirname(__FILE__) . '/WsBpel_TExtensibleElements.class.php';

// Genarated by Ezer_XsdClasses
// 

/**
 * @author Tan-Tan
 * @package Schema
 * @subpackage Types.wsbpel
 */
class WsBpel_TFaultHandlers extends WsBpel_TExtensibleElements
{
	private $catch = null;
	private $catchAll = null;


	public function getCatch()
	{
		return $this->catch;
	}
	public function setCatch($catch)
	{
		$this->catch = $catch;
	}
	

	public function getCatchAll()
	{
		return $this->catchAll;
	}
	public function setCatchAll($catchAll)
	{
		$this->catchAll = $catchAll;
	}
	
}

?>
		