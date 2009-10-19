
<?php
require_once dirname(__FILE__) . '/WsBpel_TActivity.class.php';

// Genarated by Ezer_XsdClasses
// 

/**
 * @author Tan-Tan
 * @package Schema
 * @subpackage Types.wsbpel
 */
class WsBpel_TWait extends WsBpel_TActivity
{
	private $for = null;
	private $until = null;


	public function getFor()
	{
		return $this->for;
	}
	public function setFor($for)
	{
		$this->for = $for;
	}
	

	public function getUntil()
	{
		return $this->until;
	}
	public function setUntil($until)
	{
		$this->until = $until;
	}
	
}

?>
		