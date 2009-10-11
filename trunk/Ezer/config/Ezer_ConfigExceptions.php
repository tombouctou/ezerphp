<?php

/**
 * @author Tan-Tan
 * @package Config
 * @subpackage errors
 */
class ConfigNotLoadedException extends Exception
{
	public function __construct($file)
	{
		parent::__construct("Config Not Loaded for $file", 0);
	}
}
?>