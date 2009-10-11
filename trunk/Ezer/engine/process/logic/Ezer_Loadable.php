<?php

/**
 * Project:     PHP Ezer business process manager
 * File:        Ezer_Loadable.php
 * Purpose:     Manage the loading of a storeable business process item to the memory
 * 
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation; either
 * version 2.1 of the License, or (at your option) any later version.
 *
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public
 * License along with this library; if not, write to the Free Software
 * Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
 *
 * For questions, help, comments, discussion, etc., please send
 * e-mail to tan-tan@simple.co.il
 *
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