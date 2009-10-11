<?php

/**
 * @author Tan-Tan
 * @package Engine
 * @subpackage Process.Logic.errors
 */
class Ezer_XmlPersistanceElementNotMappedException extends Exception
{
	public function __construct($class_name)
	{
		parent::__construct("Class $class_name not mapped", 0);
	}
}
?>