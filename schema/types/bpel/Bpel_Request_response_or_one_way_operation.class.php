
<?php


// Genarated by Ezer_XsdClasses
// 

/**
 * @author Tan-Tan
 * @package Schema
 * @subpackage Types.bpel
 */
class Bpel_Request_response_or_one_way_operation 
{
	private $input = null;
	private $output = null;
	private $fault = null;


	public function getInput()
	{
		return $this->input;
	}
	public function setInput(Bpel_TParam $input)
	{
		$this->input = $input;
	}
	

	public function getOutput()
	{
		return $this->output;
	}
	public function setOutput(Bpel_TParam $output)
	{
		$this->output = $output;
	}
	

	public function getFault()
	{
		return $this->fault;
	}
	public function setFault(Bpel_TFault $fault)
	{
		$this->fault = $fault;
	}
	
}

?>
		