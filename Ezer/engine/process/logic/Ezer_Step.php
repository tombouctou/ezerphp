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


require_once dirname(__FILE__) . '/../case/Ezer_StepInstance.php';
require_once 'Ezer_Loadable.php';


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