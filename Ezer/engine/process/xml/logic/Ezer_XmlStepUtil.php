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
 * Purpose:     Parse helper for steps from XML
 * @author Tan-Tan
 * @package Engine
 * @subpackage Process.Logic.XML
 */
class Ezer_XmlStepUtil
{
	public static function parse(Ezer_Step $step, DOMElement $element)
	{
		$step->setName($element->getAttribute('name'));
		
		for($i = 0;$i < $element->childNodes->length;$i++)
		{
			$childElement = $element->childNodes->item($i);
			
			if($childElement->parentNode !== $element)
				continue;
			
			if($childElement instanceof DOMComment || $childElement instanceof DOMText)
				continue;
			
			switch($childElement->nodeName)
			{
				case 'args':
					// ignore, relevant for activity step only
					break;
			
				case 'copy':
					// ignore, relevant for assign step only
					break;
					
				case 'targets':
					self::parseTargets($step, $childElement);
					break;
					
				case 'sources':
					self::parseSources($step, $childElement);
					break;
					
				default:
					throw new Ezer_XmlPersistanceElementNotMappedException($childElement->nodeName);
			}
		}
	}
	
	public static function parseTargets(Ezer_Step $step, DOMElement $element)
	{
		for($i = 0;$i < $element->childNodes->length;$i++)
		{
			$childElement = $element->childNodes->item($i);
			
			if($childElement->parentNode !== $element)
				continue;
			
			if($childElement instanceof DOMComment || $childElement instanceof DOMText)
				continue;
			
			$step->addTarget(new Ezer_XmlLink($childElement));
		}
	}
	
	public static function parseSources(Ezer_Step $step, DOMElement $element)
	{
		for($i = 0;$i < $element->childNodes->length;$i++)
		{
			$childElement = $element->childNodes->item($i);
			
			if($childElement->parentNode !== $element)
				continue;
			
			if($childElement instanceof DOMComment || $childElement instanceof DOMText)
				continue;
			
			$step->addSource(new Ezer_XmlLink($childElement));
		}
	}
}

