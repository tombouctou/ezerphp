<?php
ini_set('max_execution_time', 0);

require_once 'bootstrap.php';

/**
 * @author Tan-Tan
 * @package Examples
 * @subpackage Sockets
 */
class SocketCountHandler extends Ezer_Process
{
	private $cnt = 0;
	
	public function __construct() 
	{
		parent::__construct();
		$this->sleep = 2;
	}
	
	public function handle($command)
	{
		$this->info("handle $command");
		if(!is_numeric($command))
		{
			$this->info("command is not numeric");
			return;
		}
			
		$command = intval($command);
		for($i = 1; $i <= $command; $i++)
		{
			$this->info("counting $i");
			sleep(2);
		}
		
		$this->info("onDone");	
	}
	
	protected function onStart()
	{
		$this->info("onStart");
	}
	
	protected function onQuit()
	{
		$this->info("onQuit");
	}
	
	protected function keepRunning()
	{
		return ($this->cnt++ < 3);
	}
}

$countHandler = new SocketCountHandler();
$countHandler->run();
