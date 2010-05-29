<?php
interface Ezer_IntScope extends Ezer_IntStepContainer
{
	/**
	 * @return array<Ezer_IntVariable>
	 */
	public function getVariables();
}