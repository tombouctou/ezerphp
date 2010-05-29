<?php
interface Ezer_IntAssignStep extends Ezer_IntStep
{
	/**
	 * @return array<Ezer_AssignStepCopy>
	 */
	public function getCopies();
}