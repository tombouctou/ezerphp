<?php
require_once 'Ezer_StepInstance.php';

/**
 * Project:     PHP Ezer business process manager
 * File:        Ezer_StepContainerInstance.php
 * Purpose:     Stores a single instance for the execution of steps container for a specified case
 * 
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
 *
 * @author Tan-Tan
 * @package Engine
 * @subpackage Process.Case
 */
class Ezer_StepContainerInstance extends Ezer_StepInstance
{
	protected $step_instances;
	protected $available_instances;
	
	public function __construct(Ezer_BusinessProcessInstance &$process_instance, Ezer_StepContainer $step)
	{
		parent::__construct($process_instance, $step);
	}
	
	public function shouldRunOnServer()
	{
		return true;
	}
	
	public function start()
	{
		parent::start();
		
		foreach($this->step->steps as $step)
		{
			$step_instance = $step->createInstance($this->process_instance);
			$this->step_instances[] = $step_instance;
			
			if(count($step->in_flows))
				continue;
				
			$step_instance->flow();
		}
	}
}