<?php
require_once dirname(__FILE__) . '/../case/Ezer_StepInstance.php';
require_once 'Ezer_Loadable.php';

/**
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
 * @author Tan-Tan
 * @package Engine
 * @subpackage Process.Logic
 */
abstract class Ezer_Step extends Ezer_Loadable
{
	public $id;
	protected $name;
	
	/**
	 * @mandatory false
	 */
	protected $join_policy = Ezer_StepJoinPolicy::JOIN_AND;
	
	/**
	 * @mandatory false
	 */
	protected $max_retries = 1;
	
	public $in_flows = array();
	public $out_flows = array();
	
	public function __construct($id)
	{
		$this->id = $id;
	}

	public abstract function createInstance(Ezer_BusinessProcessInstance $process_instance);

	public function getMaxRetries()
	{
		return $this->max_retries; 
	}
	
	public function getJoinPolicy()
	{
		return $this->join_policy; 
	}
}

?>