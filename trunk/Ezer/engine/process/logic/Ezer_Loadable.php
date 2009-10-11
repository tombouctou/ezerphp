<?php

/**
 * @author Tan-Tan
 * @package Engine
 * @subpackage Process.Logic
 */
abstract class Ezer_Loadable
{
	private $loaded = array();
	
	public function __set($name, $value) 
	{
		$this->loaded[$name] = true;
		$this->$name = $value;
	}
	
	public function validate()
	{
		$class = get_class($this);
		$attributes = get_class_vars($class);
		foreach($attributes as $attribute => $value)
		{
			$annotations = $this->parseAttribute($class, $attribute);
			if(!$annotations['validate'])
				continue;
				
			if($annotations['mandatory'] && !isset($this->loaded[$attribute]))
				throw new Ezer_XmlPersistanceMissingAttributeException($attribute, $class);
		}
	}
	
	private function parseAttribute($class, $attribute)
	{
		$attr = new ReflectionProperty($class, $attribute);
		
		$annotations = array(
			'validate' => $attr->isProtected(),
			'mandatory' => true,
		);
		
		$comment = $attr->getDocComment();
		if(!$comment)
			return $annotations;
			
		if(!preg_match_all('/\s*\* @(\w+) ([^\n\r]*)/', $comment, $matches))
			return $annotations;
		
//		var_dump($matches);
		foreach($matches[1] as $index => $match)
		{
			$value = $matches[2][$index];
			
			switch($value)
			{
				case 'false':
					$value = false;
					break;
					
				case 'true':
					$value = true;
					break;
			}
			
			$annotations[$match] = $value;
		}
			
		return $annotations;
	}
}