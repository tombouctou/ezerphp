
<?php
require_once dirname(__FILE__) . '/Bpel_TExtensibleDocumented.class.php';

// Genarated by Ezer_XsdClasses
// 

/**
 * @author Tan-Tan
 * @package Schema
 * @subpackage Types.bpel
 */
class Bpel_TBindingOperation extends Bpel_TExtensibleDocumented
{
	private $input = null;
	private $output = null;
	private $fault = null;
	private $name = null;


	public function getInput()
	{
		return $this->input;
	}
	public function setInput(Bpel_TBindingOperationMessage $input)
	{
		$this->input = $input;
	}
	

	public function getOutput()
	{
		return $this->output;
	}
	public function setOutput(Bpel_TBindingOperationMessage $output)
	{
		$this->output = $output;
	}
	

	public function getFault()
	{
		return $this->fault;
	}
	public function setFault(Bpel_TBindingOperationFault $fault)
	{
		$this->fault = $fault;
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
		