<?php
interface Ezer_IntStepInstance
{
	public function persist();
	
	/**
	 * @return int
	 */
	public function getId();
	
	/**
	 * @return int
	 */
	public function getType();
	
	/**
	 * @param int $status
	 */
	public function setStatus($status);
}