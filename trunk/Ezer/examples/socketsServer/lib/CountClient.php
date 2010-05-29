<?php

/**
 * @author Tan-Tan
 * @package Examples
 * @subpackage Sockets
 */
class SocketCountClient extends Ezer_ThreadClient
{
	public function __construct(SocketCountServer $server, $php_exe)
	{
		parent::__construct($server, 'CountHandler.php', $php_exe);
	}

	public function request($task)
	{
		$pid = $this->getPid();
		$this->server->writeToAll("to thread ($pid): $task");
		parent::request($task);
	}
	
	public function handleError($result)
	{
		$this->server->writeToAll("ERROR: $result");
	}
	
	public function handleResults($result)
	{
		$result = trim($result);
		$pid = $this->getPid();
		$this->server->writeToAll("from thread ($pid): $result");
		
		if($result == 'onStart')
			$this->ready = true;
		
		if($result == 'onDone')
			$this->done();
	}
}

