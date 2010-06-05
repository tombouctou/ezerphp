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
 * Purpose:     Contains definitions of the process to execute and the data to use for that execution
 * @author Tan-Tan
 * @package Engine
 * @subpackage Process.Case
 */
class Ezer_Case implements Ezer_IntCase
{
	/**
	 * @var array
	 */
	protected $variables = array();
	
	/**
	 * @var string
	 */
	protected $process_identifier;
	
	/**
	 * @param string $process_identifier
	 */
	public function __construct($process_identifier)
	{
		$this->process_identifier = $process_identifier;
	}
	
	/**
	 * @return string
	 */
	public function getProcessIdentifier()
	{
		return $this->process_identifier;
	}
	
	/**
	 * @param array $variables
	 */
	public function setVariables(array $variables)
	{
		$this->variables = $variables;
	}
	
	/**
	 * @param string $name
	 * @param string $value
	 */
	public function addVariable($name, $value)
	{
		$this->variables[$name] = $value;
	}
	
	/**
	 * @return array
	 */
	public function getVariables()
	{
		return $this->variables;
	}
}