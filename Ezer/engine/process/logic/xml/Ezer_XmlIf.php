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
 * Purpose:     Loads an else from XML
 * @author Tan-Tan
 * @package Engine
 * @subpackage Process.Logic.XML
 */
class Ezer_XmlElse extends Ezer_Else
{
	public function __construct(DOMElement $element)
	{
		parent::__construct(uniqid('else_'));
		Ezer_XmlStepContainerUtil::parse($this, $element);
	}
}


/**
 * Purpose:     Loads an if from XML
 * @author Tan-Tan
 * @package Engine
 * @subpackage Process.Logic.XML
 */
class Ezer_XmlIf extends Ezer_If
{
	public function __construct(DOMElement $element)
	{
		parent::__construct(uniqid('if_'));
		Ezer_XmlStepContainerUtil::parse($this, $element);
		$this->parse($element);
	}

	public function parse(DOMNode $element)
	{
		for($i = 0;$i < $element->childNodes->length;$i++)
		{
			$childElement = $element->childNodes->item($i);
			
			if($childElement->parentNode !== $element)
				continue;
			
			if($childElement instanceof DOMComment || $childElement instanceof DOMText)
				continue;
			
			switch($childElement->nodeName)
			{
				case 'condition':
					$this->condition = $childElement->nodeValue;
					break;
					
				case 'else':
					$this->else = new Ezer_XmlElse($childElement);
					break;
					
				case 'elseif':
					$this->elseifs[] = new Ezer_XmlIf($childElement);
					break;
					
				case 'flow':
				case 'sequence':
				case 'activity':
				case 'assign':
				case 'if':
				case 'foreach':
				case 'repeatUntil':
				case 'while':
				case 'switch':
				case 'empty':
				case 'wait':
				case 'terminate':
				case 'throw':
				case 'rethrow':
					// ignore, handled by Ezer_XmlStepContainerUtil
					break;
					
				default:
					throw new Ezer_XmlPersistanceElementNotMappedException($childElement->nodeName);
			}
		}
	}
}

