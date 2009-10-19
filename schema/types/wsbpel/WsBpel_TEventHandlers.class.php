
<?php
require_once dirname(__FILE__) . '/WsBpel_TExtensibleElements.class.php';

// Genarated by Ezer_XsdClasses
// 
// 
// 			
// 				XSD Authors: The child element onAlarm needs to be a Local Element Declaration, 
// 				because there is another onAlarm element defined for the pick activity.
// 			
// 		

/**
 * @author Tan-Tan
 * @package Schema
 * @subpackage Types.wsbpel
 */
class WsBpel_TEventHandlers extends WsBpel_TExtensibleElements
{
	private $onEvent = null;
	private $onAlarm = null;


	public function getOnEvent()
	{
		return $this->onEvent;
	}
	public function setOnEvent($onEvent)
	{
		$this->onEvent = $onEvent;
	}
	

	public function getOnAlarm()
	{
		return $this->onAlarm;
	}
	public function setOnAlarm(WsBpel_TOnAlarmEvent $onAlarm)
	{
		$this->onAlarm = $onAlarm;
	}
	
}

?>
		