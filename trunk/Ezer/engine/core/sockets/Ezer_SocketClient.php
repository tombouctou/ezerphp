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
 * e-mail to johnathan.kanarek@gmail.com
 */


/**
 * Purpose:     Represents a single socket client
 * @author Tan-Tan
 * @package Engine
 * @subpackage Core.Sockets
 */
class Ezer_SocketClient
{
	protected $socket;
	
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