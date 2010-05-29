
<?php
require_once dirname(__FILE__) . '/Bpel_TExtensibleAttributesDocumented.class.php';

// Genarated by Ezer_XsdClasses
// 

/**
 * @author Tan-Tan
 * @package Schema
 * @subpackage Types.bpel
 */
class Bpel_TPortType extends Bpel_TExtensibleAttributesDocumented
{
	private $operation = null;
	private $name = null;


	public function getOperation()
	{
		return $this->operation;
	}
	public function setOperation(Bpel_TOperation $operation)
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
	
}

?>
		