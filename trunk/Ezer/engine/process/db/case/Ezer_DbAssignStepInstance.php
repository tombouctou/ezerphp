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
class Ezer_DbAssignStepInstance extends Ezer_AssignStepInstance
{
	/**
	 * @var Ezer_IntAssignStepInstance
	 */
	protected $db_instance;
	
	/**
	 * @param Ezer_IntAssignStepInstance $db_instance
	 * @param Ezer_ScopeInstance $case
	 * @param Ezer_AssignStep $step
	 */
	public function __construct(Ezer_IntAssignStepInstance $db_instance, Ezer_ScopeInstance &$scope_instance, Ezer_AssignStep $step)
	{
		$this->db_instance = $db_instance;
		parent::__construct($this->db_instance->getId(), $scope_instance, $step);
	}
	
	public function persist()
	{
		$this->db_instance->setStatus($this->getStatus());
		$this->db_instance->setContainer($this->scope_instance);
		$this->db_instance->persist();
	}
}

