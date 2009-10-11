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

require_once dirname(__FILE__) . '/../case/Ezer_BusinessProcessInstance.php';
require_once 'Ezer_Scope.php';


/**
 * Purpose:     Store in the memory the definitions of a business process
 * @author Tan-Tan
 * @package Engine
 * @subpackage Process.Logic
 */
class Ezer_BusinessProcess extends Ezer_Scope
{
	private $imports = array();

	public function __set($name, $value) 
	{
		switch($name)
		{
			case 'import':
				$this->imports[] = $value;
				require_once $value;
				break;
				
			case 'sequence':
				$this->steps[] = $value;
				break;
				
			default:
				parent::__set($name, $value);
				break;
		}
	}
	
	public function __construct($id)
	{
		$this->id = $id;
	}

	public function &createInstance(Ezer_ScopeInstance &$scope_instance)
	{
		throw new Exception("createBusinessProcessInstance should be used for business process");
	}
	
	public function &createBusinessProcessInstance(array $variables)
	{
		return new Ezer_BusinessProcessInstance($variables, $this);
	}
	
	public function getName()
	{
		return $this->name;
	}
	
	public function getImports()
	{
		return $this->imports;
	}
}

?>