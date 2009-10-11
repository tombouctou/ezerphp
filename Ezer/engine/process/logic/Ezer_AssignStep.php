<?php
require_once dirname(__FILE__) . '/../case/Ezer_AssignStepInstance.php';

/**
 * Project:     PHP Ezer business process manager
 * File:        Ezer_AssignStep.php
 * Purpose:     Store in the memory the definitions of an assign step
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
 * @subpackage Process.Logic
 */
class Ezer_AssignStepCopyAttribute extends Ezer_Loadable
{
	protected $variable;
	
	
	/**
	 * @mandatory false
	 */
	protected $part;	
	
	public function getVariable()
	{
		return $this->variable;
	}
	
	public function getPart()
	{
		return $this->part;
	}
}

/**
 * @author Tan-Tan
 * @package Engine
 * @subpackage Process.Logic
 */
class Ezer_AssignStepCopy extends Ezer_Loadable
{
	public $from;
	public $to;	
	
	public function __construct()
	{
	}
}

/**
 * @author Tan-Tan
 * @package Engine
 * @subpackage Process.Logic
 */
class Ezer_AssignStep extends Ezer_Step
{
	public $copy;
	
	public function __construct()
	{
	}
	
	public function createInstance(Ezer_BusinessProcessInstance $process_instance)
	{
		return new Ezer_AssignStepInstance($process_instance, $this);
	}
}

?>