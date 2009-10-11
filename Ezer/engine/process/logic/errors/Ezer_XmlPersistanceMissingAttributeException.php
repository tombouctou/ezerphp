<?php

/**
 * @author Tan-Tan
 * @package Engine
 * @subpackage Process.Logic.errors
 */
class Ezer_XmlPersistanceMissingAttributeException extends Exception
{
	public function __construct($attr_name, $class_name)
	{
		parent::__construct("Missing attribute $attr_name for $class_name", 0);
	}
}
?>