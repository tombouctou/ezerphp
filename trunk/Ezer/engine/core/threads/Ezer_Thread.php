<?php
require_once 'Ezer_ThreadInstance.php';

/**
 * Project:     PHP Ezer business process manager
 * File:        Ezer_Thread.php
 * Purpose:     Executes a single process using CLI
 * 
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