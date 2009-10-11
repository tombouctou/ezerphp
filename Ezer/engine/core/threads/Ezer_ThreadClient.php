<?php


/**
 * Project:     PHP Ezer business process manager
 * File:        Ezer_ThreadClient.php
 * Purpose:     Represents a single process on the server
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