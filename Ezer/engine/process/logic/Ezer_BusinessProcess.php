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
 * Purpose:     Store in the memory the definitions of a business process
 * @author Tan-Tan
 * @package Engine
 * @subpackage Process.Logic
 */
class Ezer_BusinessProcess extends Ezer_Scope implements Ezer_IntBusinessProcess
{
	protected $imports = array();
	
	/**
	 * @param Ezer_ScopeInstance $scope_instance
	 * @throws Exception
	 */
	public function &createInstance(Ezer_ScopeInstance &$scope_instance)
	{
		throw new Exception("createBusinessProcessInstance should be used for business process");
	}
	
	/**
	 * @param array $variables
	 * @return Ezer_BusinessProcessInstance
	 */
	public function &createBusinessProcessInstance(array $variables)
	{
		$ret = new Ezer_BusinessProcessInstance($variables, $this);
		return $ret;
	}

	/**
	 * @return string
	 */
	public function getName()
	{
		return $this->name;
	}

	/**
	 * @param string $import
	 */
	public function addImport($import)
	{
		require_once $import;
		$this->imports[] = $import;
	}

	/**
	 * @return array<string>
	 */
	public function getImports()
	{
		return $this->imports;
	}
}

