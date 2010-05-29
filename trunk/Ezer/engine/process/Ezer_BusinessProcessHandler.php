<?php
error_reporting(E_ALL);
ini_set('max_execution_time', 0);

require_once realpath(dirname(__FILE__) . '/../') . '/bootstrap.php';

/**
 * Purpose:     A single worker that executes async tasks
 * @author Tan-Tan
 * @package Engine
 * @subpackage Process
 */
class Ezer_BusinessProcessHandler extends Ezer_Process
{
	protected $shouldKeepRunning = true;
	
	public function __construct() 
	{
		parent::__construct();
		$this->sleep = 2;
	}
	
	public function handle($command)
	{
//		$this->log("handle($command)");
		
		if($command == Ezer_BusinessProcessHandlerMessages::KILL)
		{
			$this->shouldKeepRunning = false;
			return;
		}
		
		$task = unserialize(base64_decode($command));
		if(!($task instanceof Ezer_BusinessProcessWorkerTask))
		{
			$this->info(Ezer_BusinessProcessHandlerMessages::fail('Task is not of type Ezer_BusinessProcessWorkerTask'));
			return;
		}
		
		$this->handleTask($task);
	}
	
	protected function handleTask(Ezer_BusinessProcessWorkerTask $task)
	{
		$this->info(Ezer_BusinessProcessHandlerMessages::STARTED);
		$task->execute($this);
		$this->info(Ezer_BusinessProcessHandlerMessages::DONE);	
	}
	
	protected function onStart()
	{
		$this->info(Ezer_BusinessProcessHandlerMessages::READY);
	}
	
	protected function onQuit()
	{
		$this->info(Ezer_BusinessProcessHandlerMessages::QUIT);
	}
	
	protected function keepRunning()
	{
		return $this->shouldKeepRunning;
	}
	
	public function progress($percent)
	{
		$this->info(Ezer_BusinessProcessHandlerMessages::progress($percent));
	}
	
	/**
	 * Sets a variable value in the scope instance, on the server.
	 * @param $variable_path string separated by / to the variable and part that should be set
	 * @param $value the new value
	 */
	public function setVariable($variable_path, $value)
	{
		$this->info(Ezer_BusinessProcessHandlerMessages::setVar($variable_path, $value));
	}
	
	public function log($text)
	{
		$this->info(Ezer_BusinessProcessHandlerMessages::log($text));
	}
}

$countHandler = new Ezer_BusinessProcessHandler();
$countHandler->run();
