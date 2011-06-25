<?php
class ProcessController extends EzerAjaxController
{
	public function listAction()
	{
		$processes = Ezer_PropelStepPeer::retrieveActiveProcesses();
		$columns = Ezer_PropelStepPeer::getFieldNames(BasePeer::TYPE_STUDLYPHPNAME);
		
		$ret = array();
		foreach($processes as $process)
		{
			$processObject = new stdClass();
			foreach($columns as $column)
			{
				$getter = "get{$column}";
				$processObject->$column = $process->$getter();
			}
			
			$ret[] = $processObject;
		}
			
		return $ret;
	}
}