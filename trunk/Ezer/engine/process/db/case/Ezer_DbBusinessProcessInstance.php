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
class Ezer_DbBusinessProcessInstance extends Ezer_BusinessProcessInstance
{
	/**
	 * @var Ezer_IntBusinessProcessInstance
	 */
	protected $db_instance;
	
	/**
	 * @param Ezer_IntBusinessProcessInstance $db_instance
	 * @param Ezer_Case $case
	 * @param Ezer_BusinessProcess $process
	 */
	public function __construct(Ezer_IntBusinessProcessInstance $db_instance, Ezer_Case $case, Ezer_BusinessProcess $process)
	{
		$this->db_instance = $db_instance;
		parent::__construct($this->db_instance->getId(), $db_instance->getVariables(), $process);
	}

	
	public function persist()
	{
		$this->db_instance->setVariables($this->getVariables());
		$this->db_instance->setStatus($this->getStatus());
		$this->db_instance->persist();
	
		if($this->step_instances && is_array($this->step_instances))
		{
			foreach($this->step_instances as $index => $step_instance)
				$this->step_instances[$index]->persist();
		}
	}
}