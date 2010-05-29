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

require_once dirname(__FILE__) . '/../threads/Ezer_ThreadServer.php';
require_once 'Ezer_SocketClient.php';



/**
 * Purpose:     Serve as base sockets server
 * @author Tan-Tan
 * @package Engine
 * @subpackage Core.Sockets
 */
abstract class Ezer_SocketServer extends Ezer_ThreadServer
{
	private $port;
	private $socket_clients;
	private $client_counter;
	private $socket;
	
	public function __construct($sleep_time = 60, $port = 1500)
	{		
		// socket parameters
		$this->port = $port;
		$this->socket = null;
		$this->socket_clients = array();
		$this->client_counter = 0;
					
		parent::__construct($sleep_time);
	}
	
	protected function listenToThreadClients()
	{
		$this->listenToSocketClients();
		
		parent::listenToThreadClients();
	}
	
	protected function listenToSocketClients()
	{
		$read[-1] = $this->socket;
		$except[-1] = $this->socket;	
		$copy = array();
		
		foreach($this->socket_clients as $index => $client) 
		{ 
			$read[] = $client->getSocket();
			$except[] = $client->getSocket();
			$copy[$index] = $client->getSocket(); 
		}
		@$ready = socket_select($read, $write = null, $except, 1);
	
		if(!$this->isAlive())
			return;
			
		if(!$ready)
			return;
			
		$index = array_search($this->socket, $read);
		if(is_int($index))
		{ 
			@$client_sock = socket_accept($this->socket);
			if($client_sock)
			{
				$this->addSocketClient($client_sock);
			}
			else
			{
				$this->error(socket_strerror(socket_last_error($this->socket)));
			}
				
			unset($read[$index]);
		}
		
		if(count($except))
		{
			foreach($except as $client_socket)
			{
				if(!$this->isAlive())
					return;
					
				$index = array_search($client_socket, $copy);
				if(!isset($this->socket_clients[$index]))
					continue;
					
				$client = $this->socket_clients[$index];
				$this->error(socket_strerror(socket_last_error($client_socket)));
				$client->close();
				unset($this->socket_clients[$index]);
			}
		}
		
		if(!count($read))
			return;
			
		foreach($read as $client_socket)
		{
			if(!$this->isAlive())
				return;
			
			$index = array_search($client_socket, $copy);
			if(!isset($this->socket_clients[$index]))
				continue;
				
			$client = $this->socket_clients[$index];
			$this->handleClientData($client->read());
		}
	}
		
	protected function getNewSocketClient($client_sock)
	{
		return new Ezer_SocketClient($client_sock);
	}
		
	private function addSocketClient($client_sock)
	{
		global $_PUBS;
		
		$this->client_counter++;
		$this->socket_clients[$this->client_counter] = $this->getNewSocketClient($client_sock);
	}

	private function createSocketListener()
	{
		$this->socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
		if(!$this->socket)
		{
			$this->socket = null;
			throw new SocketNotCreatedException();
			return false;
		}
		
		if(!socket_bind($this->socket, '0.0.0.0', $this->port))
		{
			$this->socket = null;
			throw new SocketNotBoundedException($this->port);
			return false;
		}
		
		if(!socket_listen($this->socket, 5))
		{
			$this->socket = null;
			throw new SocketListenFailedException($this->port);
			return false;
		}
		return true;
	}
	
	public function run()
	{	
		$this->createSocketListener();
		
		parent::run();
	}
	
	public function close()
	{
		if(!is_null($this->socket))
		{
			if(count($this->socket_clients))
			{
				foreach($this->socket_clients as $index => $client)
				{
					$this->onSocketClientClientClosed();
					socket_close($client->socket);
				}
			}
			socket_close($this->socket);
		}
	}
	
	public function writeToAll($text)
	{
		if(is_null($this->socket) || !count($this->socket_clients))
			return;
			
		foreach($this->socket_clients as $index => $client)
		{
			$result = $client->write($text);
			if(!$result)
				unset($this->socket_clients[$index]);
		}
	}
}

?>