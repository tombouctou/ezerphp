
<?php
require_once dirname(__FILE__) . '/Bpel_TExtensibleAttributesDocumented.class.php';

// Genarated by Ezer_XsdClasses
// 

/**
 * @author Tan-Tan
 * @package Schema
 * @subpackage Types.bpel
 */
class Bpel_TFault extends Bpel_TExtensibleAttributesDocumented
{
	private $name = null;
	private $message = null;


	public function getName()
	{
		return $this->name;
	}
	public function setName(Bpel_NCName $name)
	{
		$this->name = $name;
	}
	

	public function getMessage()
	{
		return $this->message;
	}
	public function setMessage(Bpel_QName $message)
	{
		$this->message = $message;
	}
	
}

?>
		