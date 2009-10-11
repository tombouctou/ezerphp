<?php
require_once 'Ezer_ProcessCasePersistance.php';
require_once 'Ezer_Case.php';

/**
 * Project:     PHP Ezer business process manager
 * File:        Ezer_XmlCasePersistance.php
 * Purpose:     Load case definitions from xml file
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
class Ezer_XmlCasePersistance implements Ezer_ProcessCasePersistance
{
	private $cases = array();
	private $path = array();
	
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
			if($entry == '.' || $entry == '..')
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
	
	private function mapConfig(Ezer_Config $config)
	{
		$case = new Ezer_Case($config->identifier);
		$case->priority = $config->priority;
		
		foreach($config->variables as $variable)
			$case->variables[$variable->name] = $variable->value;
			
		return $case;
	}
	
	private function parseFile($file)
	{
		$config = new Ezer_Config($file);
		$this->cases[] = $this->mapConfig($config);
	}
	
	public function getCases()
	{
		$this->cases = array();
		$this->parseDir($this->path);
		return $this->cases;
	}
}

?>