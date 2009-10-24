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

require_once dirname(__FILE__) . '/../Ezer_AssignStep.php';


/**
 * Purpose:     Loads an assign step copy from XML
 * @author Tan-Tan
 * @package Engine
 * @subpackage Process.Logic.XML
 */
class Ezer_XmlAssignStepToAttribute extends Ezer_AssignStepToAttribute
{
	public function __construct(DOMElement $element)
	{
		$this->parse($element);
	}
	
	public function parse(DOMElement $element)
	{
		if($element->hasAttribute('variable'))
			$this->variable = $element->getAttribute('variable');
		
		for($i = 0; $i < $element->childNodes->length; $i++)
		{
			$childElement = $element->childNodes->item($i);
			
			if($childElement->parentNode !== $element)
				continue;
			
			if($childElement instanceof DOMComment || $childElement instanceof DOMText)
				continue;
			
			switch($childElement->nodeName)
			{
				case 'to':
					$this->part = new Ezer_XmlAssignStepToAttribute($childElement);
					break;
			}
		}
	}
}

/**
 * Purpose:     Loads an assign step copy from XML
 * @author Tan-Tan
 * @package Engine
 * @subpackage Process.Logic.XML
 */
class Ezer_XmlAssignStepFromAttribute extends Ezer_AssignStepFromAttribute
{
	public function __construct(DOMElement $element)
	{
		$this->parse($element);
	}
	
	public function parse(DOMElement $element)
	{
		if($element->hasAttribute('variable'))
			$this->variable = $element->getAttribute('variable');
		
		if($element->hasAttribute('value'))
			$this->value = $element->getAttribute('value');
			
		for($i = 0; $i < $element->childNodes->length; $i++)
		{
			$childElement = $element->childNodes->item($i);
			
			if($childElement->parentNode !== $element)
				continue;
			
			if($childElement instanceof DOMComment || $childElement instanceof DOMText)
				continue;
			
			switch($childElement->nodeName)
			{
				case 'from':
					$this->part = new Ezer_XmlAssignStepFromAttribute($childElement);
					break;
			}
		}
	}
}

/**
 * Purpose:     Loads an assign step copy from XML
 * @author Tan-Tan
 * @package Engine
 * @subpackage Process.Logic.XML
 */
class Ezer_XmlAssignStepCopy extends Ezer_AssignStepCopy
{
	public function __construct(DOMElement $element)
	{
		$this->parse($element);
	}
	
	public function parse(DOMElement $element)
	{
		for($i = 0; $i < $element->childNodes->length; $i++)
		{
			$childElement = $element->childNodes->item($i);
			
			if($childElement->parentNode !== $element)
				continue;
			
			if($childElement instanceof DOMComment || $childElement instanceof DOMText)
				continue;
			
			switch($childElement->nodeName)
			{
				case 'from':
					$this->from = new Ezer_XmlAssignStepFromAttribute($childElement);
					break;
					
				case 'to':
					$this->to = new Ezer_XmlAssignStepToAttribute($childElement);
					break;
			}
		}
	}
}


/**
 * Purpose:     Loads an assign step from XML
 * @author Tan-Tan
 * @package Engine
 * @subpackage Process.Logic.XML
 */
class Ezer_XmlAssignStep extends Ezer_AssignStep
{
	public function __construct(DOMElement $element)
	{
		parent::__construct(uniqid('asgn_'));
		$this->parse($element);
	}
	
	public function parse(DOMElement $element)
	{
		$this->name = $element->getAttribute('name');
		
		for($i = 0; $i < $element->childNodes->length; $i++)
		{
			$childElement = $element->childNodes->item($i);
			
			if($childElement->parentNode !== $element)
				continue;
			
			if($childElement instanceof DOMComment || $childElement instanceof DOMText)
				continue;
			
			switch($childElement->nodeName)
			{
				case 'copy':
					$this->copies[] = new Ezer_XmlAssignStepCopy($childElement);
					break;
			}
		}
	}
}

?>