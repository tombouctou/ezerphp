<?php
require_once 'Ezer_Thread.php';

/**
 * Thread server is a base multi process server
 *
 * @author Tan-Tan
 * @package Engine
 * @subpackage Core.Threads
 * 
 * @see Ezer_SocketServer
 */
abstract class Ezer_ThreadServer
{
	private $current_pid;
	private $thread_clients;
	private $sleep_time;
	protected $tasks;
	
	
	/**
	 * Generates array list of tasks to send to child processes.
	 */
	protected abstract function updateTasks();
	
	/**
	 * Kicks whatever indication that the server is still alive.
	 */
	protected abstract function kick();
	
	/**
	 * Called by the client when the task is over
	 */
	public abstract function taskDone($task);
	
	/**
	 * Should return false whenever the server should be stoped and true as long as the server should keep running.
	 * @return boolean
	 */
	protected abstract function isAlive();
		
	public function __construct($sleep_time = 60)
	{			
		$this->sleep_time = $sleep_time;
		$this->current_pid = getmypid();
		$this->thread_clients = array();
	}
	
	private function isClientsActive()
	{
		foreach($this->thread_clients as $pid => $thread)
			if(!$thread->isActive())
				unset($this->thread_clients[$pid]);
		
		return count($this->thread_clients);
	}

	protected function handleTask($task)
	{
		foreach($this->thread_clients as $pid => $client)
		{
			if(!$client->isBusy())
			{
				$client->request($task);
				return true;
			}
		}
		return false;
	}
	
	/**
	 * @param Resource $stream
	 * @return int false if stream is closed, and available data length if stream have unread data.
	 */
	protected function getDataLength($stream)
	{
		if(!is_resource($stream))
			return false;
			
        $info = fstat($stream);
        return  $info['size'];
	}
	
	
	/**
	 * Listens to the child processes and handles the data
	 */
	protected function listenToThreadClients()
	{	
		if(!count($this->thread_clients))
			return;
					
		$read_arr = array();
		$write_arr = array();
		$except_arr = array();
		
		foreach($this->thread_clients as $thread_pid => $thread)
		{		
			$read_arr[] = $thread->stdout;
			$except_arr[] = $thread->stderr;
			
			$read_list[$thread_pid] = $thread->stdout;
			$except_list[$thread_pid] = $thread->stderr;
		}
		
		$having_results = stream_select($read_arr, $write_arr, $except_arr, 5);
		if(!$having_results)
			return;
			
		foreach ($except_arr as $stream)
		{
			$thread_pid = array_search($stream, $except_list);
			$thread = $this->thread_clients[$thread_pid];
			
			while($this->getDataLength($stream) && $result = fgets($stream, 1024))
				$thread->handleError($result);
		}
		
		foreach ($read_arr as $stream)
		{
			$thread_pid = array_search($stream, $read_list);
			$thread = $this->thread_clients[$thread_pid];
			
			while($this->getDataLength($stream) && $result = fgets($stream, 1024))
				if(strlen(trim($result)))
					$thread->handleResults($result);
		}
	}
	
	
	/**
	 * Runs the server
	 */
	public function run()
	{	
		$task = null;
		
		while ($this->isAlive())
		{
			if(!count($this->tasks))
			{
				$this->updateTasks();
				if(is_array($this->tasks))
					$task = array_pop($this->tasks);
			}
			
			$this->kick();
			$this->isClientsActive();
			$this->listenToThreadClients();
			
			if(!count($this->thread_clients))
			{
				sleep($this->sleep_time);
				continue;
			}
				
			while($task)
			{
				if($this->handleTask($task))
				{
					if(is_array($this->tasks))
						$task = array_pop($this->tasks);
				}
				else
				{
					sleep($this->sleep_time);
					$this->kick();
					$this->isClientsActive();
					$this->listenToThreadClients();
				}
			}					
					
			usleep(100);
		}
		$this->close();
	}
	
	
	/**
	 * Kills all child processes
	 */
	protected function close()
	{
		foreach($this->thread_clients as $thread)
			$thread->stop();
	}
	
	
	/**
	 * Adds a single client process to the server
	 */
	public function addThreadClient(Ezer_ThreadClient $client)
	{
		$this->thread_clients[$client->getPid()] = $client; 
	}
}

?>