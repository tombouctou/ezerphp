
<?php
require_once dirname(__FILE__) . '/Bpel_TExtensibleElements.class.php';

// Genarated by Ezer_XsdClasses
// 

/**
 * @author Tan-Tan
 * @package Schema
 * @subpackage Types.bpel
 */
class Bpel_TCorrelationSets extends Bpel_TExtensibleElements
{
	private $correlationSet = null;


	public function getCorrelationSet()
	{
		return $this->correlationSet;
	}
	public function setCorrelationSet(Bpel_TCorrelationSet $correlationSet)
	{
		$this->correlationSet = $correlationSet;
	}
	
}

?>
		