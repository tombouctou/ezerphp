<?php
class ProcessController extends EzerAjaxController
{
	public function listAction()
	{
		$objects = Ezer_PropelStepPeer::retrieveActiveProcesses();
		$columns = Ezer_PropelStepPeer::getFieldNames(BasePeer::TYPE_STUDLYPHPNAME);
		
		return $this->toArray($objects, $columns);
	}
}