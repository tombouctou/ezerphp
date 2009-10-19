
<?php
require_once dirname(__FILE__) . '/WsBpel_TOnMsgCommon.class.php';

// Genarated by Ezer_XsdClasses
// 

/**
 * @author Tan-Tan
 * @package Schema
 * @subpackage Types.wsbpel
 */
class WsBpel_TOnEvent extends WsBpel_TOnMsgCommon
{
	private $scope = null;
	private $messageType = null;
	private $element = null;


	public function getScope()
	{
		return $this->scope;
	}
	public function setScope($scope)
	{
		$this->scope = $scope;
	}
	

	public function getMessageType()
	{
		return $this->messageType;
	}
	public function setMessageType(WsBpel_QName $messageType)
	{
		$this->messageType = $messageType;
	}
	

	public function getElement()
	{
		return $this->element;
	}
	public function setElement(WsBpel_QName $element)
	{
		$this->element = $element;
	}
	
}

?>
		