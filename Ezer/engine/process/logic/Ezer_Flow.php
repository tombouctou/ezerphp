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
 * Purpose:     Store in the memory the definitions of a source or target link
 * @author Tan-Tan
 * @package Engine
 * @subpackage Process.Logic
 */
class Ezer_Link
{
	protected $stepName;
	
	public function getStepName()
	{
		return $this->stepName;
	}
}

/**
 * Purpose:     Store in the memory the definitions of a flow
 * @author Tan-Tan
 * @package Engine
 * @subpackage Process.Logic
 */
class Ezer_Flow extends Ezer_StepContainer
{
	public function &createInstance(Ezer_ScopeInstance &$scope_instance)
	{
		$ret = new Ezer_FlowInstance($scope_instance, $this);
		return $ret;
	}
	
	public function addStep(Ezer_Step &$step)
	{
		// overwrite any flow definition
		$step->in_flows = array();
		$step->out_flows = array();
		
		$sources = $step->getSources();
		if($sources && is_array($sources) && count($sources))
		{
			foreach($sources as $source)
			{
				$source_name = $source->getStepName();
				$source_step = &$this->getStep($source_name);
				if($source_step)
				{
					$source_step->setOutFlow($step);
					$step->setInFlow($source_step);
				}
			}
		}
	
		$targets = $step->getTargets();
		if($targets && is_array($targets) && count($targets))
		{
			foreach($targets as $target)
			{
				$target_name = $target->getStepName();
				$target_step = &$this->getStep($target_name);
				if($target_step)
				{
					$target_step->setInFlow($step);
					$step->setOutFlow($target_step);
				}
			}
		}
		
		parent::addStep($step);
	}
}

