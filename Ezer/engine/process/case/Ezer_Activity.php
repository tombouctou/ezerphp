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
 * Purpose:     Is the base interface for all php activities
 * @author Tan-Tan
 * @package Engine
 * @subpackage Process.Case
 */
interface Ezer_Activity
{
	public function execute(array $args);
}

/**
 * Purpose:     Is the base activity for activities that will be executed by the worker processes
 * @author Tan-Tan
 * @package Engine
 * @subpackage Process.Case
 */
abstract class Ezer_AsynchronousActivity implements Ezer_Activity
{
	private $args;
	private $worker = null;

	public function serArgs(array $args)
	{
		$this->args = $args;
	}
	
	protected function progress($percent)
	{
		if($this->worker)
			$this->worker->progress($percent);
	}
	
	/**
	 * Sets a variable value in the scope instance, on the server.
	 * @param $variable_path string separated by / to the variable and part that should be set
	 * @param $value the new value
	 */
	protected function setVariable($variable_path, $value)
	{
		if($this->worker)
			$this->worker->setVariable($variable_path, $value);
	}
	
	protected function log($text)
	{
		if($this->worker)
			$this->worker->log($text);
	}
	
	public function executeOnWorker(Ezer_BusinessProcessHandler $process_worker)
	{
		$this->worker = $process_worker;
		$this->execute($this->args);
	}
}

/**
 * Purpose:     Is the base activity for activities that will be executed by the server parent process
 * @author Tan-Tan
 * @package Engine
 * @subpackage Process.Case
 */
abstract class Ezer_SynchronousActivity implements Ezer_Activity
{
}

/**
 * Purpose:     Is the base activity for activities that uses the DB resource
 * Created to enable control on the number of concurrent activities that uses the same resource
 * @author Tan-Tan
 * @package Engine
 * @subpackage Process.Case
 */
abstract class Ezer_DbActivity extends Ezer_AsynchronousActivity
{
}

/**
 * Purpose:     Is the base activity for activities that uses the File System resource
 * Created to enable control on the number of concurrent activities that uses the same resource
 * @author Tan-Tan
 * @package Engine
 * @subpackage Process.Case
 */
abstract class Ezer_FileSystemActivity extends Ezer_AsynchronousActivity
{
}

/**
 * Purpose:     Is the base activity for activities that uses the Network resource
 * Created to enable control on the number of concurrent activities that uses the same resource
 * @author Tan-Tan
 * @package Engine
 * @subpackage Process.Case
 */
abstract class Ezer_NetworkActivity extends Ezer_AsynchronousActivity
{
}

/**
 * Purpose:     Is the base activity for activities that uses the CPU resource
 * Created to enable control on the number of concurrent activities that uses the same resource
 * @author Tan-Tan
 * @package Engine
 * @subpackage Process.Case
 */
abstract class Ezer_CpuActivity extends Ezer_AsynchronousActivity
{
}

