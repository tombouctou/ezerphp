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
 * Purpose:     Loads a business process from XML
 * @author Tan-Tan
 * @package Engine
 * @subpackage Process.Logic.XML
 */
class Ezer_XmlBusinessProcess extends Ezer_BusinessProcess
{
	/**
	 * @var string - the path to save the instance 
	 */
	protected $instance_path = null;
	
	public function __construct(DOMElement $element, $instance_path)
	{
		parent::__construct(uniqid('proc_'));
		$this->parse($element);
		Ezer_XmlStepContainerUtil::parse($this, $element);
		
		$this->instance_path = $instance_path;
	}
	
	public function parse(DOMElement $element)
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
				case 'import':
					$this->addImport($childElement->nodeValue);
					break;
					
				case 'variables':
					$this->parseVariables($childElement);
					break;

				case 'sequence':
					// handled already by Ezer_XmlStepContainerUtil
					break;
					
				default:
					throw new Ezer_XmlPersistanceElementNotMappedException($childElement->nodeName);
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
	
	/**
	 * @param Ezer_Case $case
	 * @return Ezer_BusinessProcessInstance
	 */
	public function &createBusinessProcessInstance(Ezer_Case $case)
	{
		$instance_path = $this->instance_path . '/' . uniqid('inst') . '.xml';
		$ret = new Ezer_XmlBusinessProcessInstance($instance_path, $case->getVariables(), $this);
		return $ret;
	}
}

