
<?php
require_once dirname(__FILE__) . '/WsBpel_TExtensibleElements.class.php';

// Genarated by Ezer_XsdClasses
// 

/**
 * @author Tan-Tan
 * @package Schema
 * @subpackage Types.wsbpel
 */
class WsBpel_TActivity extends WsBpel_TExtensibleElements
{
	private $targets = null;
	private $sources = null;
	private $name = null;
	private $suppressJoinFailure = null;


	public function getTargets()
	{
		return $this->targets;
	}
	public function setTargets($targets)
	{
		$this->targets = $targets;
	}
	

	public function getSources()
	{
		return $this->sources;
	}
	public function setSources($sources)
	{
		$this->sources = $sources;
	}
	

	public function getName()
	{
		return $this->name;
	}
	public function setName(WsBpel_NCName $name)
	{
		$this->name = $name;
	}
	

	public function getSuppressJoinFailure()
	{
		return $this->suppressJoinFailure;
	}
	public function setSuppressJoinFailure(WsBpel_TBoolean $suppressJoinFailure)
	{
		$this->suppressJoinFailure = $suppressJoinFailure;
	}
	
}

?>
		