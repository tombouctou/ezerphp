
<?php
require_once dirname(__FILE__) . '/Bpel_TExtensibleElements.class.php';

// Genarated by Ezer_XsdClasses
// 

/**
 * @author Tan-Tan
 * @package Schema
 * @subpackage Types.bpel
 */
class Bpel_TFaultHandlers extends Bpel_TExtensibleElements
{
	private $catch = null;
	private $catchAll = null;


	public function getCatch()
	{
		return $this->catch;
	}
	public function setCatch(Bpel_TCatch $catch)
	{
		$this->catch = $catch;
	}
	

	public function getCatchAll()
	{
		return $this->catchAll;
	}
	public function setCatchAll(Bpel_TActivityOrCompensateContainer $catchAll)
	{
		$this->catchAll = $catchAll;
	}
	
}

?>
		