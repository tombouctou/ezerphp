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
 * Purpose:     Loads a business process from DB
 * @author Tan-Tan
 * @package Engine
 * @subpackage Process.Logic.DB
 */
class Ezer_DbBusinessProcess extends Ezer_BusinessProcess
{
	/**
	 * @var Ezer_IntBusinessProcess
	 */
	protected $processImpl;
	
	public function __construct(Ezer_IntBusinessProcess $processImpl)
	{
		$this->processImpl = $processImpl;
		parent::__construct($processImpl->getId());
		$this->load();
		Ezer_DbStepContainerUtil::load($this, $processImpl);
	}
	
	public function load()
	{
		$imports = $this->processImpl->getImports();
		foreach($imports as $import)
			$this->addImport($import);
			
		$variables = $this->processImpl->getVariables();
		foreach($variables as $variable)
			$this->addVariable($variable);
	}
	
	public function addVariable(Ezer_Variable $variable)
	{
		$this->variables[$variable->getName()] = $variable;
	}
	
	/**
	 * @param array $variables
	 * @return Ezer_BusinessProcessInstance
	 */
	public function &createBusinessProcessInstance(array $variables)
	{
		return $this->processImpl->createBusinessProcessInstance($variables);
	}
}

