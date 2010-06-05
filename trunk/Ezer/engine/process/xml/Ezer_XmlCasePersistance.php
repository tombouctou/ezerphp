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
 * e-mail to tan-tan@simple.co.il
 */


// TODO - add support for periodic cases.


/**
 * Purpose:     Load case definitions from xml file
 * @author Tan-Tan
 * @package Engine
 * @subpackage Process.Case
 */
class Ezer_XmlCasePersistance implements Ezer_ProcessCasePersistance
{
	protected $cases = array();
	protected $path = array();
	
	public function __construct($path)
	{
		$this->path = $path;
	}

	private function parseDir($path)
	{
		$dir = dir($path);
		
		$files = array();
		while (false !== ($entry = $dir->read())) 
		{
			if($entry == '.' || $entry == '..' || $entry == '.svn')
				continue;

			if(is_dir("$path/$entry"))
				$this->parseDir("$path/$entry");
			
			if(preg_match('/.+\.pbc/', $entry))
				$files[] = "$path/$entry";
		}
		$dir->close();
		
		foreach($files as $file)
		{
			$this->parseFile($file);
			$archive = str_replace('.pbc', '.arc', $file);
			rename($file, $archive);
		}
	}
	
	private function addVariablePart(array &$variable, $part)
	{
		if(!($part instanceof Ezer_Config))
		{
			$variable[] = $part;
			return;
		}
		
		$value = null;
		
		if(isset($part['value']))
			$value = $part['value'];
		
		if(isset($part['part']))
		{
			$value = array();
			$this->addVariablePart($value, $part['part']);
		}
	
		if($part->type == Ezer_Config::ARRAY_TYPE)
		{
			$value = array();
			$arr = $part->getArrayCopy();
			foreach($arr as $index => $part_part)
			{
				if(is_numeric($index))
					$this->addVariablePart($value, $part_part);
			}
		}
		
		if(isset($part['name']))
			$variable[$part['name']] = $value;
		else
			$variable[] = $value;
	}
	
	private function mapConfig(Ezer_Config $config)
	{
		$id = uniqid('case_');
		$case = new Ezer_Case($id, $config->identifier);
		$case->priority = $config->priority;
		
		foreach($config->variables as $variable)
		{
			$value = null;
			if(isset($variable['value']))
				$value = $variable['value'];
			
			if(isset($variable['part']))
			{
				$value = array();
				$this->addVariablePart($value, $variable['part']);
			}
			if($variable->type == Ezer_Config::ARRAY_TYPE)
			{
				$value = array();
				$arr = $variable->getArrayCopy();
				foreach($arr as $index => $part)
				{
					if(is_numeric($index))
						$this->addVariablePart($value, $part);
				}
			}
				
			$case->addVariable($variable->name, $value);
		}
			
		return $case;
	}
	
	private function parseFile($file)
	{
		$config = Ezer_Config::createFromPath($file);
		$this->cases[] = $this->mapConfig($config);
	}
	
	public function getCases()
	{
		$this->cases = array();
		$this->parseDir($this->path);
		return $this->cases;
	}
}

