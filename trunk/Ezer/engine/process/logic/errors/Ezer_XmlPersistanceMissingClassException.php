<?php

/**
 * @author Tan-Tan
 * @package Engine
 * @subpackage Process.Logic.errors
 */
class Ezer_XmlPersistanceMissingClassException extends Exception
{
	public function __construct($class_name)
	{
		parent::__construct("Missing class $class_name", 0);
	}
}
?>