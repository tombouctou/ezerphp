<?php

/**
 * @author Tan-Tan
 * @package Engine
 * @subpackage Process.Case
 */
class Ezer_Case
{
	public $variables = array();
	public $process_identifier;
	
	public function __construct($process_identifier)
	{
		$this->process_identifier = $process_identifier;
	}
}