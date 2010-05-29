<?php
interface Ezer_IntStepContainer extends Ezer_IntStep
{
	/**
	 * @return array<Ezer_IntStep>
	 */
	public function getSteps();
}