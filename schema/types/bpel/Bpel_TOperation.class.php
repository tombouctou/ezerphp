
<?php
require_once dirname(__FILE__) . '/Bpel_TExtensibleDocumented.class.php';

// Genarated by Ezer_XsdClasses
// 

/**
 * @author Tan-Tan
 * @package Schema
 * @subpackage Types.bpel
 */
class Bpel_TOperation extends Bpel_TExtensibleDocumented
{
	private $name = null;
	private $parameterOrder = null;
	private $arr_request_response_or_one_way_operation = array();
	private $arr_solicit_response_or_notification_operation = array();


	public function getName()
	{
		return $this->name;
	}
	public function setName(Bpel_NCName $name)
	{
		$this->name = $name;
	}
	

	public function getParameterOrder()
	{
		return $this->parameterOrder;
	}
	public function setParameterOrder(Bpel_NMTOKENS $parameterOrder)
	{
		$this->parameterOrder = $parameterOrder;
	}
	

	public function get()
	{
		return $this->arr_request_response_or_one_way_operation;
	}
	public function addRequest_response_or_one_way_operation(Bpel_Request_response_or_one_way_operation $request_response_or_one_way_operation)
	{
		$this->arr_request_response_or_one_way_operation[] = $request_response_or_one_way_operation;
	}
	

	public function get()
	{
		return $this->arr_solicit_response_or_notification_operation;
	}
	public function addSolicit_response_or_notification_operation(Bpel_Solicit_response_or_notification_operation $solicit_response_or_notification_operation)
	{
		$this->arr_solicit_response_or_notification_operation[] = $solicit_response_or_notification_operation;
	}
	
}

?>
		