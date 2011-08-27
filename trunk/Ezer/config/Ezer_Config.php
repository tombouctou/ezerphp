<?php

/**
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
 * e-mail to johnathan.kanarek@gmail.com
 */


/**
 * Purpose:     Parse XML file into PHP object
 * @author Tan-Tan
 * @package Config
 */
class Ezer_Config extends ArrayObject
{
	//Xml element types
	const TEXT_NODE_NAME = "#text";
	const COMMENT_NODE_NAME = "#comment";
	
	const TEXT_NODE_TYPE = 3;
	const COMMENT_NODE_TYPE = 8;
	const ELEMENT_NODE_TYPE = 1;

	//Php types
	const ARRAY_TYPE = 1;
	const CLASS_TYPE = 2;
	
	public $entityName;
	public $type = self::CLASS_TYPE;
	protected $keys;

	/**
	 * @param DOMNode $xml
	 * @return Ezer_Config
	 */
	public static function createFromNode(DOMNode $xml)
	{
		$instance = new Ezer_Config();
		$instance->loadNode($xml);
			
		return $instance;
	}
	
	/**
	 * @param string $xml file path
	 * @return Ezer_Config
	 */
	public static function createFromPath($xml)
	{
		$instance = new Ezer_Config();
		if(file_exists($xml))
			$instance->loadFile($xml);
			
		return $instance;
	}
	
	/**
	 * @param array $arr
	 * @return Ezer_Config
	 */
	public static function createFromArray(array $arr)
	{
		$instance = new Ezer_Config();
		foreach($arr as $key => $value)
		{
			$instance->keys[] = $key;
			
			if(is_array($value))
				$value = Ezer_Config::createFromArray($value);
				
			$instance[$key] = $value;
		}
			
		return $instance;
	}
	
	public function saveXml($path)
	{
		$xml = new DOMDocument();
		$xml = $this->loadXmlElement($xml, $this->toArray());
		$xml->save($path);
	}
	
	public function __get($name)
	{
		if(!isset($this[$name]))
			return null;
			
		return $this[$name];
	}

	public function toArray()
	{
		$ret = array();
		if(!is_array($this->keys) || !count($this->keys))
			return $ret;
			
		foreach($this->keys as $key)
		{
			$value = $this[$key];
			if($value instanceof Ezer_Config)
				$value = $value->toArray();
				
			$ret[$key] = $value;
		}
		return $ret;
	}

	/**
	 * @param DOMDocument $document
	 * @param DOMElement $element
	 * @param array $arr
	 * @return DOMElement
	 */
	public function loadXmlElement(DOMDocument $document, array $arr, DOMElement $element = null)
	{
		if(!$element)
			$element = $document;
			
		foreach($arr as $key => $value)
		{
			$createValue = $value;
			if(is_array($value))
				$createValue = '';

			$createName = $key;							
			if(is_numeric($key))
				$createName = 'item';
			
			$subElement = $document->createElement($createName, $createValue);
				
			if(is_array($value))
				$subElement = $this->loadXmlElement($document, $value, $subElement);
			
			if(is_numeric($key))
			{
				$attrElement = $document->createAttribute('index');
				$subElement->appendChild($attrElement);
				$subElement->setAttribute('index', $key);
			}
				
			$element->appendChild($subElement);
		}
		return $element;
	}

	public function getKeys()
	{
		return $this->keys;
	}

	protected function loadNode(DOMNode $node)
	{
		$this->entityName = $this->replaceSpecialChars($node->nodeName);
		$this->parseNode($node);
	}

	protected function loadFile($configFilePath)
	{
		$loaded = false;
		$doc = new DOMDocument();
		$loaded = $doc->load($configFilePath);

		if(!$loaded)
		{
			throw new ConfigNotLoadedException($configFilePath);
			return;
		}

		$root = $doc->documentElement;
		$this->entityName = $this->replaceSpecialChars($root->nodeName);
		$this->parseNode($root);
	}

	protected function convertToArray()
	{
		$copy = array();
		$arr = (array) $this;
		foreach($arr as $index => $data)
		{
			$copy[] = $data;
			unset($this[$index]);
		}
	
		foreach($copy as $data)
			$this[] = $data;
			
		$this->type = self::ARRAY_TYPE;
	}

	protected function parseNode(DOMNode $node)
	{
		if(!$node->hasChildNodes() && !$node->hasAttributes())
			return;
			
		for($i = 0;$i < $node->childNodes->length;$i++)
		{
			$childNode = $node->childNodes->item($i);
			$propertyName = $this->replaceSpecialChars($childNode->nodeName);
			
			if($propertyName == Ezer_Config::COMMENT_NODE_NAME)
				continue;
			
			if($propertyName == Ezer_Config::TEXT_NODE_NAME)
				continue;
				
			if($childNode->nextSibling->nodeName == $propertyName || $childNode->previousSibling->nodeName == $propertyName)
				$this->convertToArray();
		
			if(isset($this[$propertyName]))
				$this->convertToArray();
			
			$value = $this->getNodeValue($childNode);
//			if($this->type == self::ARRAY_TYPE && $value instanceof Ezer_Config)
			if($this->type == self::ARRAY_TYPE)
			{
				$this[] = $value;
			}
			else
			{
				$this[$propertyName] = $this->getNodeValue($childNode);
				$this->keys[] = $propertyName;
			}
		}
			
		for($i = 0;$i < $node->attributes->length;$i++)
		{
			$attribute = $node->attributes->item($i);
			$this[$attribute->name] = $attribute->value;
			$this->keys[] = $attribute->name;
		}
	}

	protected function getNodeValue(DOMNode $node)
	{
		if($node->hasAttributes())
			return Ezer_Config::createFromNode($node);
	
		if($node->childNodes->length > 1 || $node->firstChild->nodeType != Ezer_Config::TEXT_NODE_TYPE)
			return Ezer_Config::createFromNode($node);
			
		return $this->getTextValue($node);
	}

	protected function getChildNodesOfType(DOMNode $node, $type)
	{
		$children = array();
		$iCount = 0;
		for($i = 0;$i < $node->childNodes->length;$i++)
		{
			$child = $node->childNodes->item($i);
			if($child->nodeType == $type)
			{
				$children[$iCount] = $child;
				$iCount++;
			}
		}
		return $children;
	}

	protected function replaceSpecialChars($value)
	{
		//Replace any non-word characters with an underscore
//		echo "$value: " . preg_replace('/[-]/', '_', $value) . "\n";
		return preg_replace('/[-]/', '_', $value); //Convert non-word characters, hyphens and dots to underscores
	}

	protected function getTextValue(DOMNode $node)
	{
		if($node->hasChildNodes())
		{
			return $node->firstChild->nodeValue;
		}
		return $node->nodeValue;
	}
}


