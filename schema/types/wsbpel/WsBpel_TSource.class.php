
<?php
require_once dirname(__FILE__) . '/WsBpel_TExtensibleElements.class.php';

// Genarated by Ezer_XsdClasses
// 

/**
 * @author Tan-Tan
 * @package Schema
 * @subpackage Types.wsbpel
 */
class WsBpel_TSource extends WsBpel_TExtensibleElements
{
	private $transitionCondition = null;
	private $linkName = null;


	public function getTransitionCondition()
	{
		return $this->transitionCondition;
	}
	public function setTransitionCondition($transitionCondition)
	{
		$this->transitionCondition = $transitionCondition;
	}
	

	public function getLinkName()
	{
		return $this->linkName;
	}
	public function setLinkName(WsBpel_NCName $linkName)
	{
		$this->linkName = $linkName;
	}
	
}

?>
		