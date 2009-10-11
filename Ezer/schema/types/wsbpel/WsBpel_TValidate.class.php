
<?php
require_once dirname(__FILE__) . '/WsBpel_TActivity.class.php';

// Genarated by Ezer_XsdClasses
// 

/**
 * @author Tan-Tan
 * @package Schema
 * @subpackage Types.wsbpel
 */
class WsBpel_TValidate extends WsBpel_TActivity
{
	private $variables = null;


	public function getVariables()
	{
		return $this->variables;
	}
	public function setVariables(WsBpel_BPELVariableNames $variables)
	{
		$this->variables = $variables;
	}
	
}

?>
		