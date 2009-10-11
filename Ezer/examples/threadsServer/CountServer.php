<?php
require_once '../../engine/core/threads/Ezer_ThreadServer.php';

/**
 * @author Tan-Tan
 * @package Examples
 * @subpackage Threads
 */
class ThreadCountServer extends Ezer_ThreadServer
{
	public function __construct()
	{			
		parent::__construct(2);
	}
	
	public function taskDone($task)
	{
		echo "task $task done\n";
	}
	
	protected function updateTasks()
	{
		$this->tasks = array(3, 5);
	}
	
	protected function kick()
	{
		echo "kicked\n";
	}
	
	protected function isAlive()
	{
		return true;
	}
}

?>