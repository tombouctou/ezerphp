
<?php
require_once dirname(__FILE__) . '/Bpel_TActivity.class.php';

// Genarated by Ezer_XsdClasses
// 

/**
 * @author Tan-Tan
 * @package Schema
 * @subpackage Types.bpel
 */
class Bpel_TAssign extends Bpel_TActivity
{
	private $copy = null;


	public function getCopy()
	{
		return $this->copy;
	}
	public function setCopy(Bpel_TCopy $copy)
	{
		$this->copy = $copy;
	}
	
}

?>
		