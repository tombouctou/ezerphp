<?php
interface Ezer_IntStep
{
	const STEP_TYPE_PROCESS = 1;
	const STEP_TYPE_SCOPE = 2;
	const STEP_TYPE_FLOW = 3;
	const STEP_TYPE_SEQUENCE = 4;
	const STEP_TYPE_ACTIVITY = 5;
	const STEP_TYPE_ASSIGN = 6;
	const STEP_TYPE_IF = 7;
	const STEP_TYPE_ELSE = 8;
	const STEP_TYPE_FOREACH = 9;
	const STEP_TYPE_REPEAT_UNTIL = 10;
	const STEP_TYPE_WHILE = 11;
	const STEP_TYPE_SWITCH = 12;
	const STEP_TYPE_EMPTY = 13;
	const STEP_TYPE_WAIT = 14;
	const STEP_TYPE_TERMINATE = 14;
	const STEP_TYPE_THROW = 16;
	const STEP_TYPE_RETHROW = 17;
	
	
	const STEP_STATUS_ACTIVE = 1;
	const STEP_STATUS_DEPRECATED = 2;
	
	/**
	 * @return string
	 */
	public function getId();
	
	/**
	 * @return string
	 */
	public function getName();
	
	/**
	 * @return int
	 */
	public function getType();
}