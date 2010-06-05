<?php
interface Ezer_IntCase
{
	/**
	 * @return array
	 */
	public function getVariables();
	
	/**
	 * @return string
	 */
	public function getProcessIdentifier();
}