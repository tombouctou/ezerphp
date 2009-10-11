
<?php
require_once dirname(__FILE__) . '/WsBpel_TExpression.class.php';

// Genarated by Ezer_XsdClasses
// 

/**
 * @author Tan-Tan
 * @package Schema
 * @subpackage Types.wsbpel
 */
class WsBpel_TBranches extends WsBpel_TExpression
{
	private $successfulBranchesOnly = null;


	public function getSuccessfulBranchesOnly()
	{
		return $this->successfulBranchesOnly;
	}
	public function setSuccessfulBranchesOnly(WsBpel_TBoolean $successfulBranchesOnly)
	{
		$this->successfulBranchesOnly = $successfulBranchesOnly;
	}
	
}

?>
		