
<?php
require_once dirname(__FILE__) . '/Bpel_TExtensibleElements.class.php';

// Genarated by Ezer_XsdClasses
// 

/**
 * @author Tan-Tan
 * @package Schema
 * @subpackage Types.bpel
 */
class Bpel_TPartnerLinks extends Bpel_TExtensibleElements
{
	private $partnerLink = null;


	public function getPartnerLink()
	{
		return $this->partnerLink;
	}
	public function setPartnerLink(Bpel_TPartnerLink $partnerLink)
	{
		$this->partnerLink = $partnerLink;
	}
	
}

?>
		