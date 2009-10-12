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


require_once 'Ezer_ProcessLogicPersistance.php';
require_once 'Ezer_BusinessProcess.php';
require_once 'Ezer_ActivityStep.php';
require_once 'Ezer_Array.php';
require_once 'Ezer_AssignStep.php';
require_once 'Ezer_Sequence.php';
require_once 'Ezer_Variable.php';
require_once 'Ezer_IfElse.php';


require_once 'errors/Ezer_XmlPersistanceElementNotMappedException.php';
require_once 'errors/Ezer_XmlPersistanceMissingAttributeException.php';
require_once 'errors/Ezer_XmlPersistanceMissingClassException.php';

/**
 * Purpose:     Load business process definitions from xml file
 * @author Tan-Tan
 * @package Engine
 * @subpackage Process.Logic
 */
class Ezer_XmlLogicPersistance implements Ezer_ProcessLogicPersistance
{
	private $processes = array();
	private $xml_map;
	private $unique_id = 1;
	
	public function __construct($path)
	{
		$this->xml_map = array(
			'process' => Ezer_BusinessProcess,
			'activity' => Ezer_ActivityStep,
			'args' => Ezer_Array,
			'assign' => Ezer_AssignStep,
			'copy' => Ezer_AssignStepCopy,
			'from' => Ezer_AssignStepCopyAttribute,
			'to' => Ezer_AssignStepCopyAttribute,
			'sequence' => Ezer_Sequence,
			'variables' => Ezer_Array,
			'variable' => Ezer_Variable,
			'if' => Ezer_If,
			'else' => Ezer_Else,
			'elseifs' => Ezer_Array,
			'elseif' => Ezer_If,
		);
		
		$this->parseDir($path);
	}

	private function parseDir($path)
	{
		$dir = dir($path);
		
		while (false !== ($entry = $dir->read())) 
		{
			if($entry == '.' || $entry == '..' || $entry == '.svn')
				continue;

			if(is_dir("$path/$entry"))
				$this->parseDir("$path/$entry");
			
			$this->parseFile("$path/$entry");
		}
		$dir->close();
	}
	
	private function mapConfig(Ezer_Config $config)
	{
		if(!isset($this->xml_map[$config->entityName]))
			throw new Ezer_XmlPersistanceElementNotMappedException($config->entityName);
		
		$class = $this->xml_map[$config->entityName];
		
		if(!class_exists($class))
			throw new Ezer_XmlPersistanceMissingClassException($class);
		
		if(isset($config['id']))
			$this->unique_id = $config['id'];
			
		$object = new $class($this->unique_id++);
		
		if($config->type == Ezer_Config::ARRAY_TYPE)
		{
			foreach($config as $attribute => $value)
			{
				if(!is_numeric($attribute))
					continue;
			
				if($config->$attribute instanceof Ezer_Config)
					$object->add($this->mapConfig($value));
				else
					$object->add($value);
			}
		}
		
		$attributes = $config->getKeys();
		foreach($attributes as $attribute)
		{
			if($attribute == 'id')
				continue;
				
			if($config->type == Ezer_Config::ARRAY_TYPE && is_numeric($attribute))
				continue;
				
			if($config->$attribute instanceof Ezer_Config)
				$object->$attribute = $this->mapConfig($config->$attribute);
			else
				$object->$attribute = $config->$attribute;
		}
		
		if($object instanceof Ezer_Loadable)
			$object->validate();
			
		return $object;
	}
	
	private function parseFile($file)
	{
		$config = new Ezer_Config($file);
		$process = $this->mapConfig($config);
		$this->processes[$process->getName()] = $process;
	}
	
	public function getProcesses()
	{
		return $this->processes;
	}
}

?>