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
 * Purpose:     Store in the memory the definitions of a steps container such as sequence, flow or scope
 * @author Tan-Tan
 * @package Engine
 * @subpackage Process.Logic
 */
abstract class Ezer_StepContainer extends Ezer_Step implements Ezer_IntStepContainer
{
	public $steps = array();
	
	/**
	 * @param Ezer_Step $step
	 */
	public function addStep(Ezer_Step &$step)
	{
		$this->steps[] = &$step;
	}
	
	/**
	 * @return array<Ezer_IntStep>
	 */
	public function getSteps()
	{
		return $this->steps;
	}
	
	/**
	 * @param string $name
	 * @return Ezer_Step
	 */
	protected function &getStep($name)
	{
		foreach($this->steps as &$step)
			if($step->getName() == $name)
				return $step;
				
		$null = null;
		return $null;
	}
}

