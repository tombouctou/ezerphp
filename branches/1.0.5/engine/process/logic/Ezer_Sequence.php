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

require_once dirname(__FILE__) . '/../case/Ezer_SequenceInstance.php';
require_once 'Ezer_StepContainer.php';


/**
 * Purpose:     Store in the memory the definitions of a sequence
 * @author Tan-Tan
 * @package Engine
 * @subpackage Process.Logic
 */
class Ezer_Sequence extends Ezer_StepContainer
{
	public function &createInstance(Ezer_ScopeInstance &$scope_instance)
	{
		$ret = new Ezer_SequenceInstance($scope_instance, $this);
		return $ret;
	}
	
	public function addStep(Ezer_Step &$step)
	{
		// overwrite any flow definition
		$step->in_flows = array();
		$step->out_flows = array();
		
		parent::addStep($step);
		
		$last_index = count($this->steps) - 1;
		if($last_index <= 0)
			return;
			
		$last_step = &$this->steps[$last_index];
		$prev_step = &$this->steps[$last_index - 1];
		$last_step->in_flows[$prev_step->id] = $prev_step;
		$prev_step->out_flows[$last_step->id] = $last_step;
	}
}

?>