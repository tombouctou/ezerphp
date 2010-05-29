
<?php
require_once dirname(__FILE__) . '/Bpel_TExtensibleElements.class.php';

// Genarated by Ezer_XsdClasses
// 

/**
 * @author Tan-Tan
 * @package Schema
 * @subpackage Types.bpel
 */
class Bpel_TPartners extends Bpel_TExtensibleElements
{
	private $partner = null;


	public function getPartner()
	{
		return $this->partner;
	}
	public function setPartner(Bpel_TPartner $partner)
	{
		$this->partner = $partner;
	}
	
}

?>
		