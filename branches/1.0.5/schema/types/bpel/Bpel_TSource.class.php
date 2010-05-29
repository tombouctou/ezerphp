
<?php
require_once dirname(__FILE__) . '/Bpel_TExtensibleElements.class.php';

// Genarated by Ezer_XsdClasses
// 

/**
 * @author Tan-Tan
 * @package Schema
 * @subpackage Types.bpel
 */
class Bpel_TSource extends Bpel_TExtensibleElements
{
	private $linkName = null;
	private $transitionCondition = null;


	public function getLinkName()
	{
		return $this->linkName;
	}
	public function setLinkName($linkName)
	{
		$this->linkName = $linkName;
	}
	

	public function getTransitionCondition()
	{
		return $this->transitionCondition;
	}
	public function setTransitionCondition(Bpel_TBoolean_expr $transitionCondition)
	{
		$this->transitionCondition = $transitionCondition;
	}
	
}

?>
		