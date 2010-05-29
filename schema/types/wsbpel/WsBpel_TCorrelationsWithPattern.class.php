
<?php
require_once dirname(__FILE__) . '/WsBpel_TExtensibleElements.class.php';

// Genarated by Ezer_XsdClasses
// 
// 
// 			
// 				XSD Authors: The child element correlation needs to be a Local Element Declaration, 
// 				because there is another correlation element defined for the non-invoke activities.
// 			
// 		

/**
 * @author Tan-Tan
 * @package Schema
 * @subpackage Types.wsbpel
 */
class WsBpel_TCorrelationsWithPattern extends WsBpel_TExtensibleElements
{
	private $correlation = null;


	public function getCorrelation()
	{
		return $this->correlation;
	}
	public function setCorrelation(WsBpel_TCorrelationWithPattern $correlation)
	{
		$this->correlation = $correlation;
	}
	
}

?>
		