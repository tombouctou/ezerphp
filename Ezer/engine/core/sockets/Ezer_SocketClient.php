<?php

/**
 * @author Tan-Tan
 * @package Engine
 * @subpackage Core.Sockets
 */
class Ezer_SocketClient
{
	private $socket;
	
	public function __construct($socket)
	{
		$this->socket = $socket;
	}
	
	public function getSocket()
	{
		return $socket;
	}
	
	public function read()
	{
		return @socket_read($this->socket, 1024);
	}
	
	public function write($text)
	{
		$result = @socket_write($this->socket, $text . chr(0));
		if(!$result)
			$this->close();
			
		return $result;
	}
	
	public function close()
	{
		@socket_close($this->socket);
	}
}