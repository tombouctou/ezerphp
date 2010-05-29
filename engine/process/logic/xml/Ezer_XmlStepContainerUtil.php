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


require_once dirname(__FILE__) . '/../Ezer_StepContainer.php';
require_once dirname(__FILE__) . '/../errors/Ezer_XmlPersistanceElementNotMappedException.php';
require_once 'Ezer_XmlFlow.php';
require_once 'Ezer_XmlSequence.php';
require_once 'Ezer_XmlActivityStep.php';
require_once 'Ezer_XmlAssignStep.php';
require_once 'Ezer_XmlIf.php';


/**
 * Purpose:     Parse helper for step containers from XML
 * @author Tan-Tan
 * @package Engine
 * @subpackage Process.Logic.XML
 */
class Ezer_XmlStepContainerUtil
{
	public static function parse(Ezer_StepContainer $stepContainer, DOMElement $element)
	{
		$stepContainer->setName($element->getAttribute('name'));
		
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
					// ignore, relevant for process only
					break;
					
				case 'variables':
					// ignore, relevant for scope only
					break;
					
				case 'condition':
				case 'else':
				case 'elseif':
					// ignore, relevant for if only
					break;
					
				case 'flow':
					$stepContainer->addStep(new Ezer_XmlFlow($childElement));
					break;
					
				case 'sequence':
					$stepContainer->addStep(new Ezer_XmlSequence($childElement));
					break;
					
				case 'activity':
					$stepContainer->addStep(new Ezer_XmlActivityStep($childElement));
					break;
					
				case 'assign':
					$stepContainer->addStep(new Ezer_XmlAssignStep($childElement));
					break;
					
				case 'if':
					$stepContainer->addStep(new Ezer_XmlIf($childElement));
					break;
					
				case 'foreach':
					// TODO - implement foreach
					
				case 'repeatUntil':
					// TODO - implement repeatUntil
					
				case 'while':
					// TODO - implement while
					
				case 'switch':
					// TODO - implement switch
					
				case 'empty':
					// TODO - implement empty
					
				case 'wait':
					// TODO - implement wait
					
				case 'terminate':
					// TODO - implement terminate
					
				case 'throw':
					// TODO - implement throw
					
				case 'rethrow':
					// TODO - implement rethrow
					
				default:
					throw new Ezer_XmlPersistanceElementNotMappedException($childElement->nodeName);
			}
		}
	}
}

?>