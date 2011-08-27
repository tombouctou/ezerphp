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
	const SET = 'SET';
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
	
	/**
	 * Sets a variable value in the scope instance, on the server.
	 * @param $variable_path string separated by / to the variable and part that should be set
	 * @param $value the new value
	 */
	public static function setVar($variable_path, $value)
	{
		return self::message(self::SET, "$variable_path:$value");
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
	public function __construct(Ezer_BusinessProcessServer $server, $php_exe, $handlerPath = null)
	{
		if(is_null($handlerPath))
			$handlerPath = dirname(__FILE__) . '/Ezer_BusinessProcessHandler.php';
			
		Ezer_Log::log("Handler Path [$handlerPath]");
		parent::__construct($server, $handlerPath, $php_exe);
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

	/**
	 * Sets a variable value in the scope instance, on the server.
	 * @param $variable_path string separated by / to the variable and part that should be set
	 * @param $value the new value
	 */
	protected function setVariable($variable_path, $value)
	{
		return $this->server->setVariable($this->current_task, $variable_path, $value);
	}
	
	public function handleResults($result)
	{
		$result = trim($result);
		$pid = $this->getPid();
//		echo "from thread ($pid): $result\n";
		
		$cmd = $result;
		$data = null;
		
		if(strpos($result, ':'))
			list($cmd, $data) = explode(':', $result, 2);
			
		switch($cmd)
		{
			case Ezer_BusinessProcessHandlerMessages::READY:
				$this->ready = true;
				break;
				
			case Ezer_BusinessProcessHandlerMessages::STARTED:
				$this->started();
				break;
				
			case Ezer_BusinessProcessHandlerMessages::LOG:
				echo "Log: $data\n";
				break;
				
			case Ezer_BusinessProcessHandlerMessages::SET:
				$variable_path = null;
				$value = null;
				
				list($variable_path, $value) = explode(':', $data, 2);
				$this->setVariable($variable_path, $value);
				break;
				
			case Ezer_BusinessProcessHandlerMessages::FAILED:
				$this->failed($data);
				break;
				
			case Ezer_BusinessProcessHandlerMessages::DONE:
				$this->done();
				break;
				
			case Ezer_BusinessProcessHandlerMessages::PROGRESS:
				$this->progress($data);
				break;
				
			case Ezer_BusinessProcessHandlerMessages::QUIT:
			case Ezer_BusinessProcessHandlerMessages::KILL:
				$this->kill();
				break;
				
			default:
				echo "Unhandled command '$cmd' in Ezer_BusinessProcessClient\n";
				break;
		}
	}
	
}

