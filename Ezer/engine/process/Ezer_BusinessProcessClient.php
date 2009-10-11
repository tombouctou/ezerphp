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
 * Purpose:     Enum of availble messages from worker to server
 * @author Tan-Tan
 * @package Engine
 * @subpackage Process
 */
class Ezer_BusinessProcessHandlerMessages
{
	const READY = 'READY';
	const KILL = 'KILL';
	const STARTED = 'STARTED';
	const FAILED = 'FAILED';
	const DONE = 'DONE';
	const PROGRESS = 'PROGRESS';
	const LOG = 'LOG';
	const QUIT = 'QUIT';
	
	private static function message($type, $msg)
	{
		return "$type:$msg";
	}
	
	public static function fail($err)
	{
		return self::message(self::FAILED, $err);
	}
	
	public static function log($text)
	{
		return self::message(self::LOG, $text);
	}
	
	public static function progress($percent)
	{
		return self::message(self::PROGRESS, $percent);
	}
}


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
		parent::__construct($server, dirname(__FILE__) . '/Ezer_BusinessProcessHandler.php', $php_exe);
	}

	public function request(Ezer_BusinessProcessWorkerTask $task)
	{
		$data = base64_encode(serialize($task));
		$pid = $this->getPid();
//		echo "to thread ($pid): $data\n";
		parent::request($data);
		$this->current_task = $task;
	}
	
	public function handleError($result)
	{
		echo "ERROR: $result\n";
	}
	
	public function handleResults($result)
	{
		$result = trim($result);
		$pid = $this->getPid();
//		echo "from thread ($pid): $result\n";
		
		$cmd = $result;
		$data = null;
		
		if(strpos($result, ':'))
			list($cmd, $data) = split(':', $result, 2);
			
		switch($cmd)
		{
			case READY:
				$this->ready = true;
				break;
				
			case STARTED:
				echo "Async task started\n";
				break;
				
			case LOG:
				echo "Log: $data\n";
				break;
				
			case FAILED:
				$this->failed($data);
				break;
				
			case DONE:
				$this->done();
				break;
				
			case PROGRESS:
				$this->progress($data);
				break;
				
			case QUIT:
			case KILL:
				$this->kill();
				break;
				
			default:
				echo "Unhandled command '$cmd' in Ezer_BusinessProcessClient\n";
				break;
		}
	}
	
}

?>