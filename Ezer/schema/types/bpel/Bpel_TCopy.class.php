
<?php
require_once dirname(__FILE__) . '/Bpel_TExtensibleElements.class.php';

// Genarated by Ezer_XsdClasses
// 

/**
 * @author Tan-Tan
 * @package Schema
 * @subpackage Types.bpel
 */
class Bpel_TCopy extends Bpel_TExtensibleElements
{
	private $from = null;
	private $to = null;


	public function getFrom()
	{
		return $this->from;
	}
	public function setFrom($from)
	{
		$this->from = $from;
	}
	

	public function getTo()
	{
		return $this->to;
	}
	public function setTo($to)
	{
		$this->to = $to;
	}
	
}

?>
		