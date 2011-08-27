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
 * Purpose:     Generates a single php class file
 * @author Tan-Tan
 * @package Schema
 * @subpackage Util
 */
class Ezer_XsdClass
{
	public $name;
	public $doc = '';
	public $super_name = false;
	public $members = array();
	public $groups = array();
	
	public function save($path, $package)
	{
		$extends = '';
		$require = '';
		if($this->super_name)
		{
			$extends = "extends $this->super_name";
			$require = "require_once dirname(__FILE__) . '/$this->super_name.class.php';";
		}
		
		$this->doc = str_replace("\r", '', $this->doc);
		$doc = array('Genarated by Ezer_XsdClasses');
		$doc = array_merge($doc, explode("\n", $this->doc));
		$doc = "// " . join("\r\n// ", $doc);
		
		$vars = array();
		$functions = array();
		
		if(count($this->members))
		{
			foreach($this->members as $member => $type)
			{
				$type_def = '';
				if($type)
					$type_def = "$type ";
				
				$vars[] = "	private \$$member = null;";
				
				$uMember = ucfirst($member);
				$functions[] = "
	public function get$uMember()
	{
		return \$this->$member;
	}
	public function set$uMember(" . $type_def . "\$$member)
	{
		\$this->$member = \$$member;
	}
	";
			}
		}
		
		if(count($this->groups))
		{
			foreach($this->groups as $member => $type)
			{
				$type_def = "$type ";
				
				$vars[] = "	private \$arr_$member = array();";
				
				$uMember = ucfirst($member);
				$functions[] = "
	public function get$uMemberArray()
	{
		return \$this->arr_$member;
	}
	public function add$uMember(" . $type_def . "\$$member)
	{
		\$this->arr_${member}[] = \$$member;
	}
	";
			}
		}
		
		$vars_str = join("\n", $vars);
		$functions_str = join("\n", $functions);

		$str = "
<?php
$require

$doc

/**
 * @author Tan-Tan
 * @package Schema
 * @subpackage Types.$package
 */
class $this->name $extends
{
$vars_str

$functions_str
}

		";
		
		file_put_contents($path . '/' . $this->name . '.class.php', $str);
	}
}

/**
 * Purpose:     Generates php classes based on an XSD file
 * @author Tan-Tan
 * @package Schema
 * @subpackage Util
 */
class Ezer_XsdClasses
{
	private $prefix = '';
	private $classes = array();
	private $redefine = false;
	
	public function __construct($prefix = '')
	{
		$this->prefix = $prefix;
	}
	
	public function saveClasses($path, $package)
	{
		foreach($this->classes as $class)
			$class->save($path, $package);
	}
	
	public function loadFile($path)
	{
		echo "loading $path...";
		
		$doc = new DOMDocument();
		$loaded = $doc->load($path);

		if(!$loaded)
		{
			echo " FAILED.\n";
			return;
		}

		echo " loaded.\n";
		
		$root = $doc->documentElement;
		
		$importNodes = $doc->getElementsByTagName('import');
		foreach($importNodes as $importNode)
			$this->import($importNode);
			
		$this->parse($doc, $root);
	}
	
	private function parse(DOMDocument $doc, DOMNode $node)
	{
		$classNodes = $doc->getElementsByTagName('complexType');
		foreach($classNodes as $classNode)
			if($classNode->parentNode === $node)
				$this->parseClass($classNode);
			
		$groupNodes = $doc->getElementsByTagName('group');
		foreach($groupNodes as $groupNode)
			if($groupNode->parentNode === $node)
				$this->parseClass($groupNode);
			
		$redefineNodes = $doc->getElementsByTagName('redefine');
		$this->redefine = true;
		foreach($redefineNodes as $redefineNode)
			if($groupNode->parentNode === $node)
				$this->parse($doc, $redefineNode);
		$this->redefine = false;
	}
	
	private function import(DOMNode $importNode)
	{
		$schemaLocation = $importNode->getAttribute('schemaLocation');
		$this->loadFile($schemaLocation);
	}
	
	private function parseClass(DOMNode $classNode)
	{
		if(!$classNode->hasAttribute('name'))
		{
			echo "class type without name: " . $classNode->getNodePath() . "\n";
			return;
		}
		
		$class = new Ezer_XsdClass();
		$class->name = $this->prefix . ucfirst($this->replaceNameChars($classNode->getAttribute('name')));
		
		if(!$this->redefine && isset($this->classes[$class->name]))
		{
			echo $class->name . " already exists, make sure that classes are the same.\n";
			return;
		}
		
		for($i = 0;$i < $classNode->childNodes->length;$i++)
		{
			$childNode = $classNode->childNodes->item($i);
			
			switch($childNode->localName)
			{
				case '':
					if($childNode->nodeName == '#comment')
						$class->doc .= "\n$childNode->nodeValue";
					break;
					
				case 'anyAttribute':
					break;
					
				case 'annotation':
					$class->doc .= "\n$childNode->nodeValue";
					break;
					
				case 'attribute':
					$this->parseAttribute($class, $childNode);
					break;
					
				case 'sequence':
					$this->parseSequence($class, $childNode);
					break;
					
				case 'complexContent':
					$this->parseComplexContent($class, $childNode);
					break;
					
				case 'choice':
					$this->parseChoice($class, $childNode);
					break;
					
				default:
					echo "Unhandled class property: $childNode->localName.\n";
					break;
			}
		}
		
		$this->classes[$class->name] = $class;
	}
	
	private function parseGroup(DOMNode $groupNode)
	{
	}
	
	private function parseGroupRef(Ezer_XsdClass $class, DOMNode $groupNode)
	{
		$ref = $groupNode->getAttribute('ref');
		$attr_name = $ref;
		if(strpos($ref, ':') > 0)
			list($ns, $attr_name) = explode(':', $ref);
			
		$attr_name = $this->replaceNameChars($attr_name);
		$class->groups[$attr_name] = $this->prefix . ucfirst($attr_name);
	}
	
	private function parseAttribute(Ezer_XsdClass $class, DOMNode $attributeNode)
	{
		$type = null;
		if($attributeNode->hasAttribute('type'))
		{
			$type = $attributeNode->getAttribute('type');
			switch($type)
			{
				case 'QName':
				case 'NCName':
					$type = '';
					break;
					
				default:
					$type_name = $type;
					if(strpos($type, ':') > 0)
						list($ns, $type_name) = explode(':', $type);
						
					$type = $this->prefix . ucfirst($this->replaceNameChars($type_name));
					break;
			}
		}
		
		if($attributeNode->hasAttribute('name'))
		{
			$attr_name = $this->replaceNameChars($attributeNode->getAttribute('name'));
			$class->members[$attr_name] = $type;
		}
		elseif($attributeNode->hasAttribute('ref'))
		{
			$ref = $attributeNode->getAttribute('ref');
			$attr_name = $ref;
			if(strpos($ref, ':') > 0)
				list($ns, $attr_name) = explode(':', $ref);
				
			$attr_name = $this->replaceNameChars($attr_name);
			$class->members[$attr_name] = $type;
		}
	}
	
	private function replaceNameChars($str)
	{
		return str_replace('-', '_', $str);
	}
	
	private function parseComplexContent(Ezer_XsdClass $class, DOMNode $complexContentNode)
	{
		for($i = 0;$i < $complexContentNode->childNodes->length;$i++)
		{
			$childNode = $complexContentNode->childNodes->item($i);
		
			switch($childNode->localName)
			{
				case '':
					if($childNode->nodeName == '#comment')
						echo "$childNode->nodeValue\n";
					break;
					
				case 'extension':
					$this->parseExtension($class, $childNode);
					break;
					
				default:
					echo "Unhandled complexContent property: $childNode->localName.\n";
					break;
			}
		}
	}
	
	private function parseExtension(Ezer_XsdClass $class, DOMNode $extensionNode)
	{
		$base = $extensionNode->getAttribute('base');
		$super_name = $base;
		if(strpos($base, ':') > 0)
			list($ns, $super_name) = explode(':', $base);
			
		$class->super_name = $this->prefix . ucfirst($super_name);
	
		for($i = 0;$i < $extensionNode->childNodes->length;$i++)
		{
			$childNode = $extensionNode->childNodes->item($i);
		
			switch($childNode->localName)
			{
				case '':
					if($childNode->nodeName == '#comment')
						echo "$childNode->nodeValue\n";
					break;
					
				case 'anyAttribute':
					break;
					
				case 'annotation':
					$class->doc .= "\n$childNode->nodeValue";
					break;
					
				case 'attribute':
					$this->parseAttribute($class, $childNode);
					break;
					
				case 'sequence':
					$this->parseSequence($class, $childNode);
					break;
					
				case 'choice':
					$this->parseChoice($class, $childNode);
					break;
					
				default:
					echo "Unhandled extension property: $childNode->localName.\n";
					break;
			}
		}
	}
	
	private function parseChoice(Ezer_XsdClass $class, DOMNode $choiceNode)
	{
		for($i = 0;$i < $choiceNode->childNodes->length;$i++)
		{
			$childNode = $choiceNode->childNodes->item($i);
		
			switch($childNode->localName)
			{
				case '':
					if($childNode->nodeName == '#comment')
						echo "$childNode->nodeValue\n";
					break;
					
				case 'element':
					$this->parseAttribute($class, $childNode);
					break;
					
				case 'group':
					$this->parseGroupRef($class, $childNode);
					break;
					
				default:
					echo "Unhandled choice property: $childNode->localName.\n";
					break;
			}
		}
	}
	
	private function parseSequence(Ezer_XsdClass $class, DOMNode $sequenceNode)
	{
		for($i = 0;$i < $sequenceNode->childNodes->length;$i++)
		{
			$childNode = $sequenceNode->childNodes->item($i);
		
			switch($childNode->localName)
			{
				case '':
					if($childNode->nodeName == '#comment')
						echo "$childNode->nodeValue\n";
					break;
					
				case 'any':
					break;
					
				case 'sequence':
					$this->parseSequence($class, $childNode);
					break;
					
				case 'element':
					$this->parseAttribute($class, $childNode);
					break;
					
				case 'choice':
					$this->parseChoice($class, $childNode);
					break;
					
				case 'group':
					$this->parseGroupRef($class, $childNode);
					break;
					
				default:
					echo "Unhandled sequence property: $childNode->localName.\n";
					break;
			}
		}
	}
}
