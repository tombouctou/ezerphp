<?php
require_once 'Ezer_ThreadInstance.php';

/**
 * Thread executes a single process using CLI
 *
 * @author Tan-Tan
 * @package Engine
 * @subpackage Core.Threads
 */
class Ezer_Thread
{
	const STREAM_STD_IN = 0;
	const STREAM_STD_OUT = 1;
	const STREAM_STD_ERR = 2;
	
	public $stdin;
	public $stdout;
	public $stderr;
	
	private $pid;
	private $pref;
	
	public function __construct($url, $php_exe = 'php')
	{
		$url = realpath($url);
		
		$pipes = (array)null;
		$descriptor = array(
								Ezer_Thread::STREAM_STD_IN => array ('pipe', 'r'),
								Ezer_Thread::STREAM_STD_OUT => array ('pipe', 'w'),
								Ezer_Thread::STREAM_STD_ERR => array ('pipe', 'w')
							);

		$this->pref = proc_open("$php_exe $url", $descriptor, $pipes, null);
		if(!$this->pref)
			return null;
		
		usleep(100);
		$staus = proc_get_status($this->pref);
		$this->pid = $staus['pid'];
		
		$this->stdin = $pipes[Ezer_Thread::STREAM_STD_IN];
		$this->stdout = $pipes[Ezer_Thread::STREAM_STD_OUT];
		$this->stderr = $pipes[Ezer_Thread::STREAM_STD_ERR];
		
		if(!stream_set_blocking($this->stdout, false))
			stream_set_timeout($this->stdout, 0, 10);
		
		if(!stream_set_blocking($this->stderr, false))
			stream_set_timeout($this->stderr, 0, 10);
	}
		
	public function getPid()
	{
		return $this->pid;
	}
		
	public function isActive()
	{
		$proc = proc_get_status($this->pref);
		return $proc['running'];
		
//		if(!is_resource($this->stdout))
//			return false;
//			
//		$f = stream_get_meta_data ($this->stdout);
//		if($f['eof'])
//			return fasle;
	}
	
	public function stop()
	{
		$this->request(Ezer_Process::MSG_EXIT);
		$r = proc_close($this->pref);
		$this->pref = null;
		
//		fclose($this->stdin);
//		fclose($this->stdout);
//		fclose($this->stderr);
		
		return $r;
	}
	
	public function request($request)
	{
		fwrite($this->stdin, "$request\n");
		fflush($this->stdin);
	}
}
?>