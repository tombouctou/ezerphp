
<?php
require_once dirname(__FILE__) . '/Bpel_TExtensibleAttributesDocumented.class.php';

// Genarated by Ezer_XsdClasses
// 

/**
 * @author Tan-Tan
 * @package Schema
 * @subpackage Types.bpel
 */
class Bpel_TPart extends Bpel_TExtensibleAttributesDocumented
{
	private $name = null;
	private $element = null;
	private $type = null;


	public function getName()
	{
		return $this->name;
	}
	public function setName(Bpel_NCName $name)
	{
		$this->name = $name;
	}
	

	public function getElement()
	{
		return $this->element;
	}
	public function setElement(Bpel_QName $element)
	{
		$this->element = $element;
	}
	

	public function getType()
	{
		return $this->type;
	}
	public function setType(Bpel_QName $type)
	{
		$this->type = $type;
	}
	
}

?>
		