
<?php
require_once dirname(__FILE__) . '/WsBpel_TExtensibleElements.class.php';

// Genarated by Ezer_XsdClasses
// 

/**
 * @author Tan-Tan
 * @package Schema
 * @subpackage Types.wsbpel
 */
class WsBpel_TCopy extends WsBpel_TExtensibleElements
{
	private $to = null;
	private $keepSrcElementName = null;
	private $ignoreMissingFromData = null;
	private $arr_fromGroup = array();


	public function getTo()
	{
		return $this->to;
	}
	public function setTo($to)
	{
		$this->to = $to;
	}
	

	public function getKeepSrcElementName()
	{
		return $this->keepSrcElementName;
	}
	public function setKeepSrcElementName(WsBpel_TBoolean $keepSrcElementName)
	{
		$this->keepSrcElementName = $keepSrcElementName;
	}
	

	public function getIgnoreMissingFromData()
	{
		return $this->ignoreMissingFromData;
	}
	public function setIgnoreMissingFromData(WsBpel_TBoolean $ignoreMissingFromData)
	{
		$this->ignoreMissingFromData = $ignoreMissingFromData;
	}
	

	public function get()
	{
		return $this->arr_fromGroup;
	}
	public function addFromGroup(WsBpel_FromGroup $fromGroup)
	{
		$this->arr_fromGroup[] = $fromGroup;
	}
	
}

?>
		