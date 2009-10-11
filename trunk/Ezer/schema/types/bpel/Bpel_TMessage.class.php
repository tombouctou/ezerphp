
<?php
require_once dirname(__FILE__) . '/Bpel_TExtensibleDocumented.class.php';

// Genarated by Ezer_XsdClasses
// 

/**
 * @author Tan-Tan
 * @package Schema
 * @subpackage Types.bpel
 */
class Bpel_TMessage extends Bpel_TExtensibleDocumented
{
	private $part = null;
	private $name = null;


	public function getPart()
	{
		return $this->part;
	}
	public function setPart(Bpel_TPart $part)
	{
		$this->part = $part;
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
		