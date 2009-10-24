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

require_once dirname(__FILE__) . '/../Ezer_BusinessProcess.php';
require_once 'Ezer_XmlVariable.php';
require_once 'Ezer_XmlSequence.php';


/**
 * Purpose:     Loads a business process from XML
 * @author Tan-Tan
 * @package Engine
 * @subpackage Process.Logic.XML
 */
class Ezer_XmlBusinessProcess extends Ezer_BusinessProcess
{
	public function __construct(DOMElement $element)
	{
		parent::__construct(uniqid('proc_'));
		$this->parse($element);
	}
	
	public function parse(DOMElement $element)
	{
		$this->name = $element->getAttribute('name');
		
		for($i = 0;$i < $element->childNodes->length;$i++)
		{
			$childElement = $element->childNodes->item($i);
			
			if($childElement->parentNode !== $element)
				continue;
			
			if($childElement instanceof DOMComment || $childElement instanceof DOMText)
				continue;
			
			switch($childElement->nodeName)
			{
				case 'import':
					require_once $childElement->nodeValue;
					break;
					
				case 'variables':
					$this->parseVariables($childElement);
					break;
					
				case 'sequence':
					$this->addStep(new Ezer_XmlSequence($childElement));
					break;
			}
		}
	}
	
	public function parseVariables(DOMElement $variablesElement)
	{
		for($i = 0;$i < $variablesElement->childNodes->length;$i++)
		{
			$childElement = $variablesElement->childNodes->item($i);
			
			if($childElement instanceof DOMComment || $childElement instanceof DOMText)
				continue;
				
			$this->variables[] = new Ezer_XmlVariable($childElement);
		}
	}
}

?>