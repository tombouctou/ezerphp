
<?php
require_once dirname(__FILE__) . '/WsBpel_TExtensibleElements.class.php';

// Genarated by Ezer_XsdClasses
// 

/**
 * @author Tan-Tan
 * @package Schema
 * @subpackage Types.wsbpel
 */
class WsBpel_TVariable extends WsBpel_TExtensibleElements
{
	private $name = null;
	private $messageType = null;
	private $type = null;
	private $element = null;
	private $arr_fromGroup = array();


	public function getName()
	{
		return $this->name;
	}
	public function setName(WsBpel_BPELVariableName $name)
	{
		$this->name = $name;
	}
	

	public function getMessageType()
	{
		return $this->messageType;
	}
	public function setMessageType(WsBpel_QName $messageType)
	{
		$this->messageType = $messageType;
	}
	

	public function getType()
	{
		return $this->type;
	}
	public function setType(WsBpel_QName $type)
	{
		$this->type = $type;
	}
	

	public function getElement()
	{
		return $this->element;
	}
	public function setElement(WsBpel_QName $element)
	{
		$this->element = $element;
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
		