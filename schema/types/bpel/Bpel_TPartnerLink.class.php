
<?php
require_once dirname(__FILE__) . '/Bpel_TExtensibleElements.class.php';

// Genarated by Ezer_XsdClasses
// 

/**
 * @author Tan-Tan
 * @package Schema
 * @subpackage Types.bpel
 */
class Bpel_TPartnerLink extends Bpel_TExtensibleElements
{
	private $name = null;
	private $partnerLinkType = null;
	private $myRole = null;
	private $partnerRole = null;


	public function getName()
	{
		return $this->name;
	}
	public function setName($name)
	{
		$this->name = $name;
	}
	

	public function getPartnerLinkType()
	{
		return $this->partnerLinkType;
	}
	public function setPartnerLinkType($partnerLinkType)
	{
		$this->partnerLinkType = $partnerLinkType;
	}
	

	public function getMyRole()
	{
		return $this->myRole;
	}
	public function setMyRole($myRole)
	{
		$this->myRole = $myRole;
	}
	

	public function getPartnerRole()
	{
		return $this->partnerRole;
	}
	public function setPartnerRole($partnerRole)
	{
		$this->partnerRole = $partnerRole;
	}
	
}

?>
		