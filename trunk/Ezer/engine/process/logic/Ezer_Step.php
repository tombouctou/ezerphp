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
 * Purpose:     Enum for join policies
 * @author Tan-Tan
 * @package Engine
 * @subpackage Process.Logic
 */
class Ezer_StepJoinPolicy
{
	const JOIN_AND = 1;
	const JOIN_OR = 2;
}

/**
 * Purpose:     Store in the memory the definitions of a step
 * @author Tan-Tan
 * @package Engine
 * @subpackage Process.Logic
 */
abstract class Ezer_Step implements Ezer_IntStep
{
	protected $id;
	protected $name;
	protected $type;
	protected $join_policy = Ezer_StepJoinPolicy::JOIN_AND;
	protected $max_retries = 1;
	protected $priority = 1;
	protected $targets = array();
	protected $sources = array();
	
	protected $in_flows = array();
	protected $out_flows = array();
	
	public function __construct($id)
	{
		$this->id = $id;
	}

	/**
	 * @param Ezer_ScopeInstance $scope_instance
	 * @return Ezer_StepInstance
	 */
	public abstract function &createInstance(Ezer_ScopeInstance &$scope_instance);

	/**
	 * @return string
	 */
	public function getId()
	{
		return $this->id; 
	}

	/**
	 * @return string
	 */
	public function getName()
	{
		return $this->name; 
	}

	/**
	 * @return int
	 */
	public function getType()
	{
		return $this->type; 
	}
	
	/**
	 * @param string $name
	 */
	public function setName($name)
	{
		$this->name = $name; 
	}
	
	/**
	 * @param Ezer_Link $target
	 */
	public function addTarget(Ezer_Link $target)
	{
		$this->targets[] = $target;
	}
	
	/**
	 * @param Ezer_Link $source
	 */
	public function addSource(Ezer_Link $source)
	{
		$this->sources[] = $source;
	}
	
	
	/**
	 * @return int
	 */
	public function getMaxRetries()
	{
		return $this->max_retries; 
	}
	
	/**
	 * @return Ezer_StepJoinPolicy
	 */
	public function getJoinPolicy()
	{
		return $this->join_policy; 
	}
	
	/**
	 * @return int
	 */
	public function getPriority()
	{
		return $this->priority; 
	}
	
	/**
	 * @return array<Ezer_Link>
	 */
	public function getTargets()
	{
		return $this->targets; 
	}
	
	/**
	 * @return array<Ezer_Link>
	 */
	public function getSources()
	{
		return $this->sources; 
	}
	
	/**
	 * @return int
	 */
	public function getInFlowsCount()
	{
		return count($this->in_flows);
	}
	
	/**
	 * @param string $step_id
	 * @return bool
	 */
	public function hasInFlow($step_id)
	{
		return isset($this->in_flows[$step_id]);
	}
	
	/**
	 * @return array<Ezer_Step>
	 */
	public function getOutFlows()
	{
		return $this->out_flows;
	}
	
	/**
	 * @param Ezer_Step $step
	 */
	public function setOutFlow(Ezer_Step &$step)
	{
		if(!isset($this->out_flows[$step->id]))
		{
			$this->out_flows[$step->id] = $step;
//			echo "flow " . $this->getName() . " => " . $step->getName() . "\n";
		} 
	}
	
	/**
	 * @param Ezer_Step $step
	 */
	public function setInFlow(Ezer_Step &$step)
	{
		if(!isset($this->in_flows[$step->id]))
		{
			$this->in_flows[$step->id] = $step;
//			echo "flow " . $step->getName() . " => " . $this->getName() . "\n";
		} 
	}
}

