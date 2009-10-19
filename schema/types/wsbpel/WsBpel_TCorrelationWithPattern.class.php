
<?php
require_once dirname(__FILE__) . '/WsBpel_TCorrelation.class.php';

// Genarated by Ezer_XsdClasses
// 

/**
 * @author Tan-Tan
 * @package Schema
 * @subpackage Types.wsbpel
 */
class WsBpel_TCorrelationWithPattern extends WsBpel_TCorrelation
{
	private $pattern = null;


	public function getPattern()
	{
		return $this->pattern;
	}
	public function setPattern(WsBpel_TPattern $pattern)
	{
		$this->pattern = $pattern;
	}
	
}

?>
		