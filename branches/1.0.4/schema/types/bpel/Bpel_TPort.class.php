
<?php
require_once dirname(__FILE__) . '/Bpel_TExtensibleDocumented.class.php';

// Genarated by Ezer_XsdClasses
// 

/**
 * @author Tan-Tan
 * @package Schema
 * @subpackage Types.bpel
 */
class Bpel_TPort extends Bpel_TExtensibleDocumented
{
	private $name = null;
	private $binding = null;


	public function getName()
	{
		return $this->name;
	}
	public function setName(Bpel_NCName $name)
	{
		$this->name = $name;
	}
	

	public function getBinding()
	{
		return $this->binding;
	}
	public function setBinding(Bpel_QName $binding)
	{
		$this->binding = $binding;
	}
	
}

?>
		