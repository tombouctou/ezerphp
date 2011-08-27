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
 * Purpose:     Stores a single instance for the execution of a sequence for a specified case
 * @author Tan-Tan
 * @package Engine
 * @subpackage Process.Case
 */
class Ezer_XmlSequenceInstance extends Ezer_SequenceInstance
{
	public function __construct(Ezer_ScopeInstance &$scope_instance, Ezer_Sequence $sequence)
	{
		$id = uniqid('i_');
		parent::__construct($id, $scope_instance, $sequence);
	}
	
	public function getFullStatus()
	{
		$data = array(
			'sequence-instance' => array(
				'status' => $this->getStatus(),
				'steps' => null,
			)
		);
		
		if($this->step_instances && is_array($this->step_instances))
		{
			foreach($this->step_instances as $step_instance)
				$data['sequence-instance']['steps'][] = $step_instance->getFullStatus();
		}
		
		return $data;
	}
}

