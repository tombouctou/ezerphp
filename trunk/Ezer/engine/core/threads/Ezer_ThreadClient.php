<?php


/**
 * Thread client represents a single process on the server
 *
 * @author Tan-Tan
 * @package Engine
 * @subpackage Core.Threads
 */
abstract class Ezer_ThreadClient extends Ezer_Thread
{
	const STATUS_NEW = 1;
	const STATUS_STARTED = 2;
	const STATUS_DONE = 3;
	
	protected $ready;
	protected $busy;
	protected $progress;
	protected $status;
	protected $server;
	protected $current_task;
					
	public abstract function handleError($result);
	public abstract function handleResults($result);
	
	public function __construct(Ezer_ThreadServer $server, $url, $php_exe = 'php')
	{
		parent::__construct($url, $php_exe);
	
		$this->server = $server;	
		$this->ready = false;
		$this->busy = false;
		$this->progress = 0;
		$this->status = Ezer_ThreadClient::STATUS_NEW;
	}
	
	public function done()
	{
		$this->busy = false;
		$this->progress = 100;
		$this->status = Ezer_ThreadClient::STATUS_DONE;
		
		return $this->server->taskDone($this->current_task);
	}
	
	public function request($task)
	{
		$this->current_task = $task;
		$this->busy = true;
		$this->progress = 0;
		$this->status = Ezer_ThreadClient::STATUS_STARTED;
		
		parent::request($task);
	}
	
	public function isReady()
	{
		return $this->ready;	
	}
	
	public function isBusy()
	{
		return (!$this->ready) || $this->busy;	
	}
	
	public function getProgress()
	{
		return $this->progress;	
	}
	
	public function getStatus()
	{
		return $this->status;	
	}
			
}
?>