<?php
interface Ezer_IntCase
{
	/**
	 * @return string
	 */
	public function getId();
	
	/**
	 * @return array
	 */
	public function getVariables();
	
	/**
	 * @return string
	 */
	public function getProcessIdentifier();
}