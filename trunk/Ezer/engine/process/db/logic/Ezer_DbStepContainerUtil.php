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
 * Purpose:     Load helper for step containers from DB
 * @author Tan-Tan
 * @package Engine
 * @subpackage Process.Logic.DB
 */
class Ezer_DbStepContainerUtil
{
	public static function load(Ezer_StepContainer $stepContainer, Ezer_IntStepContainer $container)
	{
		$stepContainer->setName($container->getName());
		
		$steps = $container->getSteps();
		foreach($steps as $step)
		{
			switch($step->getType())
			{
				case Ezer_IntStep::STEP_TYPE_SCOPE:
					$stepContainer->addStep(new Ezer_DbScope($step));
					break;
			
				case Ezer_IntStep::STEP_TYPE_FLOW:
					$stepContainer->addStep(new Ezer_DbFlow($step));
					break;
					
				case Ezer_IntStep::STEP_TYPE_SEQUENCE:
					$stepContainer->addStep(new Ezer_DbSequence($step));
					break;
			
				case Ezer_IntStep::STEP_TYPE_ACTIVITY:
					$stepContainer->addStep(new Ezer_DbActivityStep($step));
					break;
			
				case Ezer_IntStep::STEP_TYPE_ASSIGN:
					$stepContainer->addStep(new Ezer_DbAssignStep($step));
					break;
			
				case Ezer_IntStep::STEP_TYPE_IF:
					$stepContainer->addStep(new Ezer_DbIf($step));
					break;
			
//				case Ezer_IntStep::STEP_TYPE_FOREACH:
//					$stepContainer->addStep(new Ezer_DbForeach($step));
//					break;
//			
//				case Ezer_IntStep::STEP_TYPE_REPEAT_UNTIL:
//					$stepContainer->addStep(new Ezer_DbRepeatUntil($step));
//					break;
//			
//				case Ezer_IntStep::STEP_TYPE_WHILE:
//					$stepContainer->addStep(new Ezer_DbWhile($step));
//					break;
//			
//				case Ezer_IntStep::STEP_TYPE_SWITCH:
//					$stepContainer->addStep(new Ezer_DbSwitch($step));
//					break;
//			
//				case Ezer_IntStep::STEP_TYPE_EMPTY:
//					$stepContainer->addStep(new Ezer_DbEmpty($step));
//					break;
//			
//				case Ezer_IntStep::STEP_TYPE_WAIT:
//					$stepContainer->addStep(new Ezer_DbWait($step));
//					break;
//			
//				case Ezer_IntStep::STEP_TYPE_TERMINATE:
//					$stepContainer->addStep(new Ezer_DbTerminate($step));
//					break;
//			
//				case Ezer_IntStep::STEP_TYPE_THROW:
//					$stepContainer->addStep(new Ezer_DbThrow($step));
//					break;
//			
//				case Ezer_IntStep::STEP_TYPE_RETHROW:
//					$stepContainer->addStep(new Ezer_DbRethrow($step));
//					break;
			}
		}
	}
}

