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
 * Purpose:     Load business process definitions from xml file
 * @author Tan-Tan
 * @package Engine
 * @subpackage Process.Logic.DB
 */
class Ezer_PropelLogicPersistance implements Ezer_ProcessLogicPersistance
{
	private $processes = array();
	
	public function __construct($config)
	{
		Propel::setConfiguration($config);
		Propel::initialize();
		
		$this->loadProcesses();
	}

	private function loadProcesses()
	{
		$dbProcesses = Ezer_PropelStepPeer::retrieveActiveProcesses();
		foreach($dbProcesses as $dbProcess)
		{
			$process = new Ezer_DbBusinessProcess($dbProcess);
			$this->processes[$process->getId()] = $process;
		}
	}
	
	public function getProcesses()
	{
		return $this->processes;
	}
}

