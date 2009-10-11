<?php

/**
 * Project:     PHP Ezer business process manager
 * File:        Ezer_StepActivityClassNotFoundException.php
 * Purpose:     Thrown when an trying to initiate unknown activity class
 * 
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
 *
 * @author Tan-Tan
 * @package Engine
 * @subpackage Process.Logic.errors
 */
class Ezer_StepActivityClassNotFoundException extends Exception
{
	public function __construct($process_identifier)
	{
		parent::__construct("Step activity class $process_identifier not found", 0);
	}
}
?>