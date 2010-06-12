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
 * Purpose:     Store in the memory the definitions of an 'else'
 * @author Tan-Tan
 * @package Engine
 * @subpackage Process.Logic
 */
class Ezer_Else extends Ezer_SingleStepContainer
{
	public function &createInstance(Ezer_ScopeInstance &$scope_instance)
	{
		$ret = new Ezer_ElseInstance($scope_instance, $this);
		return $ret;
	}
	
	public function addStep(Ezer_Step $step)
	{
		if(count($this->steps))
			throw new Ezer_SyntaxException('Else object can contain only on step');
			
		// overwrite any flow definition
		$step->in_flows = array();
		$step->out_flows = array();
		
		parent::addStep($step);
	}
}

/**
 * Purpose:     Store in the memory the definitions of an 'if'
 * @author Tan-Tan
 * @package Engine
 * @subpackage Process.Logic
 */
class Ezer_If extends Ezer_SingleStepContainer implements Ezer_IntIf
{
	/**
	 * @var Ezer_Else
	 */
	public $else = null;
	
	/**
	 * @var array
	 */
	public $elseifs = array();
	
	protected $condition = null;
	
	public function &createInstance(Ezer_ScopeInstance &$scope_instance)
	{
		return new Ezer_IfInstance($scope_instance, $this);
	}
	
	public function addStep(Ezer_Step $step)
	{
		// overwrite any flow definition
		$step->in_flows = array();
		$step->out_flows = array();
				
		if(count($this->steps))
			throw new Ezer_SyntaxException('If object can contain only one step [' . $step->getName() . ']');
			
		parent::addStep($step);
	}
	
	public function getCondition()
	{
		return $this->condition;
	}
	
	public function setCondition($condition)
	{
		$this->condition = $condition;
	}
	
	public function addElseIf(Ezer_If $elseIf)
	{
		$this->elseifs[] = $elseIf;
	}
	
	public function setElse(Ezer_Else $else)
	{
		$this->else = $else;
	}
}

