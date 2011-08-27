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
 * Purpose:     Store in the memory the definitions of a copy attribute
 * @author Tan-Tan
 * @package Engine
 * @subpackage Process.Logic
 */
abstract class Ezer_AssignStepCopyAttribute
{
	/**
	 * @var string
	 */
	protected $variable;
	
	/**
	 * @var Ezer_AssignStepCopyAttribute
	 */
	protected $part;
	
	public function __construct($variable = null, Ezer_AssignStepCopyAttribute $part = null)
	{
		$this->variable = $variable;
		$this->part = $part;
	}
	
	/**
	 * @return string
	 */
	public function getVariable()
	{
		return $this->variable;
	}
	
	/**
	 * @return boolean
	 */
	public function hasPart()
	{
		return !is_null($this->part);
	}
	
	/**
	 * @return boolean
	 */
	public function hasVariable()
	{
		return !is_null($this->variable);
	}
	
	/**
	 * @return Ezer_AssignStepCopyAttribute
	 */
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
	/**
	 * @var unknown_type
	 */
	protected $value;

	public function getVariable()
	{
		return $this->variable;
	}
	
	/**
	 * @return boolean
	 */
	public function hasValue()
	{
		return !is_null($this->value);
	}
	
	public function getValue()
	{
		return $this->value;
	}
	
	public function setValue($value)
	{
		$this->value = $value;
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
	/**
	 * @var Ezer_AssignStepFromAttribute
	 */
	public $from;
	
	/**
	 * @var Ezer_AssignStepToAttribute
	 */
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
class Ezer_AssignStep extends Ezer_Step implements Ezer_IntAssignStep
{
	/**
	 * @var array<Ezer_AssignStepCopy>
	 */
	public $copies;
	
	public function __construct()
	{
	}
	
	/* (non-PHPdoc)
	 * @see engine/process/logic/Ezer_Step#createInstance($scope_instance)
	 */
	public function &createInstance(Ezer_ScopeInstance &$scope_instance)
	{
		$ret = new Ezer_AssignStepInstance($scope_instance, $this);
		return $ret;
	}
	
	
	/**
	 * @return array<Ezer_AssignStepCopy>
	 */
	public function getCopies()
	{
		return $this->copies;
	}
	
	
	/**
	 * @param array<Ezer_AssignStepCopy> $copies
	 */
	public function setCopies(array $copies)
	{
		$this->copies = $copies;
	}
}

