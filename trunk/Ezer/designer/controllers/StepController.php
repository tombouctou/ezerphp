<?php
class StepController extends EzerAjaxController
{
	/**
	 * @param Ezer_PropelStepFilter $filter
	 * @param Ezer_PropelPager $pager
	 * @return array<stdClass> steps
	 */
	public function listAction(Ezer_PropelStepFilter $filter = null, Ezer_PropelPager $pager = null)
	{
		$objects = $filter->execute($pager);
		$columns = Ezer_PropelStepPeer::getFieldNames(BasePeer::TYPE_STUDLYPHPNAME);
		
		return $this->toArray($objects, $columns);
	}
}