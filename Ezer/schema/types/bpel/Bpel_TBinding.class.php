
<?php
require_once dirname(__FILE__) . '/Bpel_TExtensibleDocumented.class.php';

// Genarated by Ezer_XsdClasses
// 

/**
 * @author Tan-Tan
 * @package Schema
 * @subpackage Types.bpel
 */
class Bpel_TBinding extends Bpel_TExtensibleDocumented
{
	private $operation = null;
	private $name = null;
	private $type = null;


	public function getOperation()
	{
		return $this->operation;
	}
	public function setOperation(Bpel_TBindingOperation $operation)
	{
		$this->operation = $operation;
	}
	

	public function getName()
	{
		return $this->name;
	}
	public function setName(Bpel_NCName $name)
	{
		$this->name = $name;
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
		