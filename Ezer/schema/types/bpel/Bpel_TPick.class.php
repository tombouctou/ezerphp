
<?php
require_once dirname(__FILE__) . '/Bpel_TActivity.class.php';

// Genarated by Ezer_XsdClasses
// 

/**
 * @author Tan-Tan
 * @package Schema
 * @subpackage Types.bpel
 */
class Bpel_TPick extends Bpel_TActivity
{
	private $onMessage = null;
	private $onAlarm = null;
	private $createInstance = null;


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
	

	public function getCreateInstance()
	{
		return $this->createInstance;
	}
	public function setCreateInstance(Bpel_TBoolean $createInstance)
	{
		$this->createInstance = $createInstance;
	}
	
}

?>
		