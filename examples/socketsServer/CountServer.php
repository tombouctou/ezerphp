<?php

require_once '../../engine/core/threads/Ezer_ThreadServer.php';
require_once '../../engine/core/sockets/Ezer_SocketServer.php';

/**
 * @author Tan-Tan
 * @package Examples
 * @subpackage Sockets
 */
class SocketCountServer extends Ezer_SocketServer
{
	public function __construct()
	{			
		parent::__construct(2);
	}
	
	public function taskProgressed($task, $percent)
	{
	}
	
	public function taskFailed($task, $err)
	{
	}
	
	public function taskDone($task)
	{
		echo "task $task done\n";
	}
	
	public function updateTasks()
	{
		$this->tasks = array(3, 5);
	}
	
	protected function kick()
	{
		$this->writeToAll('kicked');
	}
	
	protected function isAlive()
	{
		return true;
	}
	
	public function addThreadClient(SocketCountClient $client)
	{
		$pid = $client->getPid();
		$this->writeToAll("add thread: $pid");
		parent::addThreadClient($client);
	}
	
	protected function getNewSocketClient($client_sock)
	{
		$this->writeToAll("new socket connected");
		return new Ezer_SocketClient($client_sock);
	}
	
	public function writeToAll($text)
	{
		echo "$text\n";
		parent::writeToAll("$text\r\n");
	}
}

?>