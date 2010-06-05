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


/**
 * Purpose:     Stores a single instance for the execution of a business process for a specified case
 * @author Tan-Tan
 * @package Engine
 * @subpackage Process.Case
 */
class Ezer_XmlBusinessProcessInstance extends Ezer_BusinessProcessInstance
{
	protected $path;
	protected $debugIndex = 1;
	protected $debugPath = false;
	
	
	/**
	 * @param string $path location to save the xml
	 * @param array $variables
	 * @param Ezer_BusinessProcess $process
	 */
	public function __construct($path, array $variables, Ezer_BusinessProcess $process)
	{
		$this->path = $path;
		parent::__construct($variables, $process);
	}
	
	public function var2Array(Ezer_XmlVariable $var)
	{
		$ret = array(
			'name' => $var->getName(),
			'value' => $var->getValue(),
		);
		if(count($var->parts))
		{
			$ret['parts'] = array();
			foreach($ret['parts'] as $name => $part)
				$ret['parts'][$name] = $this->var2Array($part);
		}
		return $ret;
	}
	
	public function getFullStatus()
	{
		$data = array(
			'process-instance' => array(
				'status' => $this->getStatus(),
				'vars' => $this->getValues(),
				'process' => null,
				'steps' => null,
			)
		);
		
		if($this->process)
		{
			$vars = array();
			foreach($this->process->getVariables() as $name => $var)
				$vars[$name] = $this->var2Array($var);
			
			$data['process-instance']['process'] = array(
				'name' => $this->process->getName(),
				'vars' => $vars,
			);
		}
			
		if($this->step_instances && is_array($this->step_instances))
		{
			foreach($this->step_instances as $step_instance)
				$data['process-instance']['steps'][] = $step_instance->getFullStatus();
		}
		
		return $data;
	}
	
	public function save()
	{
		$data = $this->getFullStatus();
		$xml = Ezer_Config::createFromArray($data);
		
		$path = $this->path;
		if($this->debugPath)
			$path = str_replace('.xml', '.' . $this->debugIndex++ . '.xml', $this->path);
			
		$xml->saveXml($path);
	}
}