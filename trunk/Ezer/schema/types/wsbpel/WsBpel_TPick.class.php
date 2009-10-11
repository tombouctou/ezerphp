
<?php
require_once dirname(__FILE__) . '/WsBpel_TActivity.class.php';

// Genarated by Ezer_XsdClasses
// 
// 
// 			
// 				XSD Authors: The child element onAlarm needs to be a Local Element Declaration, 
// 				because there is another onAlarm element defined for event handlers.
// 			
// 		

/**
 * @author Tan-Tan
 * @package Schema
 * @subpackage Types.wsbpel
 */
class WsBpel_TPick extends WsBpel_TActivity
{
	private $onMessage = null;
	private $onAlarm = null;
	private $createInstance = null;


	public function getOnMessage()
	{
		return $this->onMessage;
	}
	public function setOnMessage($onMessage)
	{
		$this->onMessage = $onMessage;
	}
	

	public function getOnAlarm()
	{
		return $this->onAlarm;
	}
	public function setOnAlarm(WsBpel_TOnAlarmPick $onAlarm)
	{
		$this->onAlarm = $onAlarm;
	}
	

	public function getCreateInstance()
	{
		return $this->createInstance;
	}
	public function setCreateInstance(WsBpel_TBoolean $createInstance)
	{
		$this->createInstance = $createInstance;
	}
	
}

?>
		