<?php

/**
 * @author Tan-Tan
 * @package Engine
 * @subpackage Process.Logic.errors
 */
class Ezer_StepClassNotActivityException extends Exception
{
	public function __construct($process_identifier)
	{
		parent::__construct("Step activity class $process_identifier is not an activity", 0);
	}
}
?>