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



/**
 * Purpose:     Executed by CLI and communicate with the {@link Ezer_ThreadServer}
 * @author Tan-Tan
 * @package Engine
 * @subpackage Core.Threads
 */
abstract class Ezer_Process
{
	const MSG_EXIT = 'exit';
	
	private $stdin;
	private $stderr;
	
	protected $current_pid;
	protected $sleep = 1;
	
	abstract public function handle($command);
	abstract protected function onStart();
	abstract protected function onQuit();
	abstract protected function keepRunning();
	
	public function __construct() 
	{
		$this->current_pid = getmypid();;
		
		$this->stdin = fopen("php://stdin", "r");
//		$this->stdout = fopen("php://stdout", "w");
		$this->stderr = fopen("php://stderr", "w");
		
		if(!stream_set_blocking($this->stdin, false))
			stream_set_timeout($this->stdin, 0, 10);
	}
		
	public function run()
	{
		$this->onStart();
		do
		{
	        $this->loop();
	    	sleep($this->sleep);
	    	
		}while($this->keepRunning());
		
		$this->onQuit();
		return true;
	}
	
	protected function loop()
	{
		$this->handleCommand($this->checkCommand()); // for none blocking
//		$this->handleCommand($this->getCommand()); // for blocking
		
		$this->info();
	}
	
	protected function handleCommand($command)
	{
		if(!$command)
			return;
			
		$command = trim($command);
		switch($command)
		{
			case '':
				return;
				
			case Ezer_Process::MSG_EXIT:
				$this->on_quit();
				exit;
				
			default:
				$this->handle($command);
		}
	}
	
	protected function checkCommand()
	{
        $info = fstat($this->stdin);
        
        if(!$info['size'])
        	return false;
        	 
        return $this->getCommand();
	}
	
	protected function getCommand()
	{
		return fgets($this->stdin, 1024);
	}
	
	protected function info($text = '')
	{
		echo "$text\n";
		ob_flush();
	}
	
	protected function error($text)
	{
		fwrite($this->stderr, "$text\n");
		fflush($this->stderr);
	}
}
?>