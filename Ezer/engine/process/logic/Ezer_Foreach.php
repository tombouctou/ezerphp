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
 * Purpose:     Store in the memory the definitions of a sequence
 * @author Tan-Tan
 * @package Engine
 * @subpackage Process.Logic
 */
class Ezer_Foreach extends Ezer_StepContainer implements Ezer_IntForeach
{
	/**
	 * @var Ezer_AssignStepFromAttribute $arg items array arg name
	 */
	protected $arg;
	
	/**
	 * @var int paralell or serial
	 */
	protected $order_type;
	
	public function &createInstance(Ezer_ScopeInstance &$scope_instance)
	{
		$ret = new Ezer_ForeachInstance($scope_instance, $this);
		return $ret;
	}
	
	public function addStep(Ezer_Step &$step)
	{
		// overwrite any flow definition
		$step->in_flows = array();
		$step->out_flows = array();
		
		if(count($this->steps))
			throw new Ezer_SyntaxException('Foreach object can contain only one step [' . $step->getName() . ']');
			
		parent::addStep($step);
	}
	
	/**
	 * @param int $order_type paralell or serial
	 */
	public function setOrderType($order_type)
	{
		$this->order_type = $order_type;
	}
	
	/**
	 * @param Ezer_AssignStepFromAttribute $arg items array arg name
	 */
	public function setArg(Ezer_AssignStepFromAttribute $arg)
	{
		$this->arg = $arg;
	}
	
	/**
	 * @return Ezer_AssignStepFromAttribute items array argument name
	 */
	public function getArg()
	{
		return $this->arg;
	}
	
	/**
	 * @return int paralell or serial
	 */
	public function getOrderType()
	{
		return $this->order_type;
	}
}

