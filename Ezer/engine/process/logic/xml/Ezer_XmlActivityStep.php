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
 * Purpose:     Loads an activity step from XML
 * @author Tan-Tan
 * @package Engine
 * @subpackage Process.Logic.XML
 */
class Ezer_XmlActivityStep extends Ezer_ActivityStep
{
	public function __construct(DOMElement $element)
	{
		parent::__construct(uniqid('act_'));
		Ezer_XmlStepUtil::parse($this, $element);
		$this->parse($element);
	}
	
	public function parse(DOMElement $element)
	{
		$this->class = $element->getAttribute('class');
		
		if($element->hasAttribute('args'))
			$this->args[] = $element->getAttribute('args');
		
		for($i = 0; $i < $element->childNodes->length; $i++)
		{
			$childElement = $element->childNodes->item($i);
			
			if($childElement->parentNode !== $element)
				continue;
			
			if($childElement instanceof DOMComment || $childElement instanceof DOMText)
				continue;
			
			switch($childElement->nodeName)
			{
				case 'args':
					$this->parseArgs($childElement);
					break;
					
				case 'targets':
				case 'sources':
					// already handled by Ezer_XmlStepUtil
					break;
					
				default:
					throw new Ezer_XmlPersistanceElementNotMappedException($childElement->nodeName);
			}
		}
	}
	
	public function parseArgs(DOMElement $argsElement)
	{
		for($i = 0; $i < $argsElement->childNodes->length; $i++)
		{
			$childElement = $argsElement->childNodes->item($i);
			
			if($childElement->parentNode !== $argsElement)
				continue;
			
			if($childElement instanceof DOMComment || $childElement instanceof DOMText)
				continue;
				
			$this->args[] = $childElement->nodeValue;
		}
	}
}

