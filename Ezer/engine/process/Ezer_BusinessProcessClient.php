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


require_once dirname(__FILE__) . '/../core/threads/Ezer_ThreadClient.php';

/**
 * Purpose:     Run a BPM worker process
 * @author Tan-Tan
 * @package Engine
 * @subpackage Process
 */
class Ezer_BusinessProcessClient extends Ezer_ThreadClient
{
	public function __construct(Ezer_BusinessProcessServer $server, $php_exe)
	{
		parent::__construct($server, 'Ezer_BusinessProcessHandler.php', $php_exe);
	}

	public function request($task)
	{
		$pid = $this->getPid();
		echo "to thread ($pid): $task\n";
		parent::request($task);
	}
	
	public function handleError($result)
	{
		echo "ERROR: $result\n";
	}
	
	public function handleResults($result)
	{
		$result = trim($result);
		$pid = $this->getPid();
		echo "from thread ($pid): $result\n";
		
		if($result == 'onStart')
			$this->ready = true;
		
		if($result == 'onDone')
			$this->done();
	}
	
}

?>