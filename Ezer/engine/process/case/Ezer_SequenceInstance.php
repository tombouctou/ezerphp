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
 * Purpose:     Stores a single instance for the execution of a sequence for a specified case
 * @author Tan-Tan
 * @package Engine
 * @subpackage Process.Case
 */
class Ezer_SequenceInstance extends Ezer_StepContainerInstance
{
	public function __construct($id, Ezer_ScopeInstance &$scope_instance, Ezer_Sequence $sequence)
	{
		parent::__construct($id, $scope_instance, $sequence);
	}
	
	public function start()
	{
		parent::start();
	}
	
	public function isAvailable()
	{
		if(!parent::isStarted())
			return parent::isAvailable();
			
		foreach($this->step_instances as $index => $step_instance)
		{
			if(!$step_instance->isDone())
				break;
				
//			echo get_class($step_instance) . "(" . $step_instance->getName() . ") is done\n";
			$index++;
			if(count($this->step_instances) <= $index)
			{
				$this->done();
			}
			else
			{
				$next_step = &$this->step_instances[$index];
				$next_step->flow($step_instance->getStepId());
			}
		}
		
		return false;
	}
	
	/**
	 * @return int
	 */
	public function getType()
	{
		return Ezer_IntStep::STEP_TYPE_SEQUENCE;
	}
}

