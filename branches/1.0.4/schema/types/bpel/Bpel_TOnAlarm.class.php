
<?php
require_once dirname(__FILE__) . '/Bpel_TActivityContainer.class.php';

// Genarated by Ezer_XsdClasses
// 

/**
 * @author Tan-Tan
 * @package Schema
 * @subpackage Types.bpel
 */
class Bpel_TOnAlarm extends Bpel_TActivityContainer
{
	private $for = null;
	private $until = null;


	public function getFor()
	{
		return $this->for;
	}
	public function setFor(Bpel_TDuration_expr $for)
	{
		$this->for = $for;
	}
	

	public function getUntil()
	{
		return $this->until;
	}
	public function setUntil(Bpel_TDeadline_expr $until)
	{
		$this->until = $until;
	}
	
}

?>
		