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
 * Purpose:     Is the base interface for all php activities
 * @author Tan-Tan
 * @package Engine
 * @subpackage Process.Case
 */
interface Ezer_Activity
{
	public function execute(array $args);
	public function setVariable($variable_path, $value);
	public function log($text);
}

/**
 * Purpose:     Is the base activity for activities that will be executed by the worker processes
 * @author Tan-Tan
 * @package Engine
 * @subpackage Process.Case
 */
abstract class Ezer_AsynchronousActivity implements Ezer_Activity
{
	/**
	 * @var array
	 */
	private $args;
	
	/**
	 * @var Ezer_BusinessProcessHandler
	 */
	private $worker = null;

	public function setArgs(array $args)
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
	public function setVariable($variable_path, $value)
	{
		if($this->worker)
			$this->worker->setVariable($variable_path, $value);
	}
	
	public function log($text)
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
	/**
	 * @var Ezer_StepInstance
	 */
	private $step_instance;
	
	/**
	 * @param array $args
	 * @param Ezer_ScopeInstance $scope_instance
	 * @return bool
	 */
	public function executeOnServer(array $args, Ezer_StepInstance $step_instance = null)
	{
		$this->step_instance = $step_instance;
		return $this->execute($args);
	}
	
	public function setVariable($to, $value)
	{
		if($this->step_instance)
			return $this->step_instance->setVariable($to, $value);
			
		return false;
	}
	
	public function addVariable($to, $value)
	{
		if($this->step_instance)
			return $this->step_instance->addVariable($to, $value);
			
		return false;
	}
	
	public function log($text)
	{
		Ezer_Log::log($text);
	}
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

