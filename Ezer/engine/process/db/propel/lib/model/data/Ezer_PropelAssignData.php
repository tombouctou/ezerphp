<?php


/**
 * @package    lib.model.data
 */
class Ezer_PropelAssignStepData extends Ezer_PropelData 
{
	/**
	 * @var array<Ezer_AssignStepCopy>
	 */
	protected $copies = array();
	
	/**
	 * @return array<Ezer_AssignStepCopy>
	 */
	public function getCopies()
	{
		return $this->copies;
	}
	
	/**
	 * @param Ezer_AssignStepCopy $copy
	 */
	public function addCopy(Ezer_AssignStepCopy $copy)
	{
		$this->copies[] = $copy;
	}
}
