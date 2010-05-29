
<?php
require_once dirname(__FILE__) . '/Bpel_TActivity.class.php';

// Genarated by Ezer_XsdClasses
// 

/**
 * @author Tan-Tan
 * @package Schema
 * @subpackage Types.bpel
 */
class Bpel_TSwitch extends Bpel_TActivity
{
	private $case = null;
	private $otherwise = null;


	public function getCase()
	{
		return $this->case;
	}
	public function setCase($case)
	{
		$this->case = $case;
	}
	

	public function getOtherwise()
	{
		return $this->otherwise;
	}
	public function setOtherwise(Bpel_TActivityContainer $otherwise)
	{
		$this->otherwise = $otherwise;
	}
	
}

?>
		