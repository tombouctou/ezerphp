<?php

/**
 * @author Tan-Tan
 * @package Engine
 * @subpackage Process.Logic.errors
 */
class Ezer_StepActivityClassNotFoundException extends Exception
{
	public function __construct($process_identifier)
	{
		parent::__construct("Step activity class $process_identifier not found", 0);
	}
}
?>