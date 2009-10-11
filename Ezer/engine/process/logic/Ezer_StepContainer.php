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


require_once dirname(__FILE__) . '/../case/Ezer_StepContainerInstance.php';
require_once 'Ezer_Step.php';


/**
 * Purpose:     Store in the memory the definitions of a steps container such as sequence, flow or scope
 * @author Tan-Tan
 * @package Engine
 * @subpackage Process.Logic
 */
abstract class Ezer_StepContainer extends Ezer_Step
{
	public $steps = array();
	
	public function add(Ezer_Step $step)
	{
		$this->steps[] = $step;
	}
}

?>