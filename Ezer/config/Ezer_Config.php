<?php
require_once 'Ezer_ConfigExceptions.php';

/**
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
	public $type = CLASS_TYPE;
	private $keys;

	public function __construct($xml)
	{
		if(is_a($xml, DOMNode))
			$this->loadNode($xml);
		elseif(file_exists($xml))
			$this->loadFile($xml);
	}
	
	public function __get($name)
	{
		if(!isset($this[$name]))
			return null;
			
		return $this[$name];
	}

	public function getKeys()
	{
		return $this->keys;
	}

	private function loadNode(DOMNode $node)
	{
		$this->entityName = $this->replaceSpecialChars($node->nodeName);
		$this->parseNode($node);
	}

	private function loadFile($configFilePath)
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

	private function convertToArray()
	{
		$copy = array();
		foreach($this as $index => $data)
		{
			$copy[] = $data;
			unset($this[$index]);
		}
	
		foreach($copy as $data)
			$this[] = $data;
			
		$this->type = self::ARRAY_TYPE;
	}

	private function parseNode(DOMNode $node)
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

	private function getNodeValue(DOMNode $node)
	{
		if($node->hasAttributes())
			return new Ezer_Config($node);
	
		if($node->childNodes->length > 1 || $node->firstChild->nodeType != Ezer_Config::TEXT_NODE_TYPE)
			return new Ezer_Config($node);
			
		return $this->getTextValue($node);
	}

	private function getChildNodesOfType(DOMNode $node, $type)
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

	private function replaceSpecialChars($value)
	{
		//Replace any non-word characters with an underscore
		return ereg_replace("[\\W-]", "_", $value); //Convert non-word characters, hyphens and dots to underscores
	}

	private function getTextValue(DOMNode $node)
	{
		if($node->hasChildNodes())
		{
			return $node->firstChild->nodeValue;
		}
		return $node->nodeValue;
	}
}


?>