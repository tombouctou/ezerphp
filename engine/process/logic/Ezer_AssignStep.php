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

require_once dirname(__FILE__) . '/../case/Ezer_AssignStepInstance.php';


/**
 * Purpose:     Store in the memory the definitions of a copy attribute
 * @author Tan-Tan
 * @package Engine
 * @subpackage Process.Logic
 */
abstract class Ezer_AssignStepCopyAttribute
{
	protected $variable;
	protected $part;
	
	public function getVariable()
	{
		return $this->variable;
	}
	
	public function hasPart()
	{
		return !is_null($this->part);
	}
	
	public function hasVariable()
	{
		return !is_null($this->variable);
	}
	
	public function getPart()
	{
		return $this->part;
	}
}

/**
 * Purpose:     Store in the memory the definitions of a copy to attribute
 * @author Tan-Tan
 * @package Engine
 * @subpackage Process.Logic
 */
class Ezer_AssignStepToAttribute extends Ezer_AssignStepCopyAttribute
{
}

/**
 * Purpose:     Store in the memory the definitions of a copy from attribute
 * @author Tan-Tan
 * @package Engine
 * @subpackage Process.Logic
 */
class Ezer_AssignStepFromAttribute extends Ezer_AssignStepCopyAttribute
{
	protected $value;

	public function getVariable()
	{
		return $this->variable;
	}
	
	public function hasValue()
	{
		return !is_null($this->value);
	}
	
	public function getValue()
	{
		return $this->value;
	}
}

/**
 * Purpose:     Store in the memory the definitions of a copy assignment
 * @author Tan-Tan
 * @package Engine
 * @subpackage Process.Logic
 */
class Ezer_AssignStepCopy
{
	public $from;
	public $to;	
	
	public function __construct()
	{
	}
}

/**
 * Purpose:     Store in the memory the definitions of an assign step
 * @author Tan-Tan
 * @package Engine
 * @subpackage Process.Logic
 */
class Ezer_AssignStep extends Ezer_Step
{
	public $copies;
	
	public function __construct()
	{
	}
	
	public function &createInstance(Ezer_ScopeInstance &$scope_instance)
	{
		$ret = new Ezer_AssignStepInstance($scope_instance, $this);
		return $ret;
	}
}

?>