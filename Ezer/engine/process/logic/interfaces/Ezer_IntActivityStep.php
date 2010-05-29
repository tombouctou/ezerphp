<?php
interface Ezer_IntActivityStep extends Ezer_IntStep
{
	/**
	 * @return array<string>
	 */
	public function getArgs();
	
	/**
	 * @return string
	 */
	public function getClass();
}