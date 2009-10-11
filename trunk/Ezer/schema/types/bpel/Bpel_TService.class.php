
<?php
require_once dirname(__FILE__) . '/Bpel_TExtensibleDocumented.class.php';

// Genarated by Ezer_XsdClasses
// 

/**
 * @author Tan-Tan
 * @package Schema
 * @subpackage Types.bpel
 */
class Bpel_TService extends Bpel_TExtensibleDocumented
{
	private $port = null;
	private $name = null;


	public function getPort()
	{
		return $this->port;
	}
	public function setPort(Bpel_TPort $port)
	{
		$this->port = $port;
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
		