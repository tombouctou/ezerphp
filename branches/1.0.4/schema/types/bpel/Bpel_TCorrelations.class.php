
<?php
require_once dirname(__FILE__) . '/Bpel_TExtensibleElements.class.php';

// Genarated by Ezer_XsdClasses
// 

/**
 * @author Tan-Tan
 * @package Schema
 * @subpackage Types.bpel
 */
class Bpel_TCorrelations extends Bpel_TExtensibleElements
{
	private $correlation = null;


	public function getCorrelation()
	{
		return $this->correlation;
	}
	public function setCorrelation(Bpel_TCorrelation $correlation)
	{
		$this->correlation = $correlation;
	}
	
}

?>
		