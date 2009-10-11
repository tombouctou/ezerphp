
<?php
require_once dirname(__FILE__) . '/Bpel_TExtensibleElements.class.php';

// Genarated by Ezer_XsdClasses
// 

/**
 * @author Tan-Tan
 * @package Schema
 * @subpackage Types.bpel
 */
class Bpel_TEventHandlers extends Bpel_TExtensibleElements
{
	private $onMessage = null;
	private $onAlarm = null;


	public function getOnMessage()
	{
		return $this->onMessage;
	}
	public function setOnMessage(Bpel_TOnMessage $onMessage)
	{
		$this->onMessage = $onMessage;
	}
	

	public function getOnAlarm()
	{
		return $this->onAlarm;
	}
	public function setOnAlarm(Bpel_TOnAlarm $onAlarm)
	{
		$this->onAlarm = $onAlarm;
	}
	
}

?>
		