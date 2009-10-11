
<?php


// Genarated by Ezer_XsdClasses
// 

/**
 * @author Tan-Tan
 * @package Schema
 * @subpackage Types.bpel
 */
class Bpel_Solicit_response_or_notification_operation 
{
	private $output = null;
	private $input = null;
	private $fault = null;


	public function getOutput()
	{
		return $this->output;
	}
	public function setOutput(Bpel_TParam $output)
	{
		$this->output = $output;
	}
	

	public function getInput()
	{
		return $this->input;
	}
	public function setInput(Bpel_TParam $input)
	{
		$this->input = $input;
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
		