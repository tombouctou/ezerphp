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

require_once dirname(__FILE__) . '/../Ezer_Flow.php';
require_once dirname(__FILE__) . '/../errors/Ezer_XmlPersistanceElementNotMappedException.php';
require_once 'Ezer_XmlStepContainerUtil.php';


/**
 * Purpose:     Loads a flow link from XML
 * @author Tan-Tan
 * @package Engine
 * @subpackage Process.Logic.XML
 */
class Ezer_XmlLink extends Ezer_Link
{
	public function __construct(DOMElement $element)
	{
		$this->parse($element);
	}

	public function parse(DOMNode $element)
	{
		if($element->hasAttribute('stepName'))
			$this->stepName = $element->getAttribute('stepName');
	}
}


/**
 * Purpose:     Loads a flow from XML
 * @author Tan-Tan
 * @package Engine
 * @subpackage Process.Logic.XML
 */
class Ezer_XmlFlow extends Ezer_Flow
{
	public function __construct(DOMElement $element)
	{
		parent::__construct(uniqid('flow_'));
		Ezer_XmlStepContainerUtil::parse($this, $element);
	}
}

?>