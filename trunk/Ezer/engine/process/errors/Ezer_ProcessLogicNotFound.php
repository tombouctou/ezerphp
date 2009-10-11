<?php

/**
 * @author Tan-Tan
 * @package Engine
 * @subpackage Process.Logic.errors
 */
class Ezer_ProcessLogicNotFound extends Exception
{
	public function __construct($process_identifier)
	{
		parent::__construct("Process logic $process_identifier not found", 0);
	}
}
?>