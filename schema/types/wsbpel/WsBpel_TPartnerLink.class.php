
<?php
require_once dirname(__FILE__) . '/WsBpel_TExtensibleElements.class.php';

// Genarated by Ezer_XsdClasses
// 

/**
 * @author Tan-Tan
 * @package Schema
 * @subpackage Types.wsbpel
 */
class WsBpel_TPartnerLink extends WsBpel_TExtensibleElements
{
	private $name = null;
	private $partnerLinkType = null;
	private $myRole = null;
	private $partnerRole = null;
	private $initializePartnerRole = null;


	public function getName()
	{
		return $this->name;
	}
	public function setName(WsBpel_NCName $name)
	{
		$this->name = $name;
	}
	

	public function getPartnerLinkType()
	{
		return $this->partnerLinkType;
	}
	public function setPartnerLinkType(WsBpel_QName $partnerLinkType)
	{
		$this->partnerLinkType = $partnerLinkType;
	}
	

	public function getMyRole()
	{
		return $this->myRole;
	}
	public function setMyRole(WsBpel_NCName $myRole)
	{
		$this->myRole = $myRole;
	}
	

	public function getPartnerRole()
	{
		return $this->partnerRole;
	}
	public function setPartnerRole(WsBpel_NCName $partnerRole)
	{
		$this->partnerRole = $partnerRole;
	}
	

	public function getInitializePartnerRole()
	{
		return $this->initializePartnerRole;
	}
	public function setInitializePartnerRole(WsBpel_TBoolean $initializePartnerRole)
	{
		$this->initializePartnerRole = $initializePartnerRole;
	}
	
}

?>
		