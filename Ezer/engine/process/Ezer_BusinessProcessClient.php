<?php
require_once dirname(__FILE__) . '/../core/threads/Ezer_ThreadClient.php';

/**
 * @author Tan-Tan
 * @package Engine
 * @subpackage Process
 */
class Ezer_BusinessProcessClient extends Ezer_ThreadClient
{
	public function __construct(Ezer_BusinessProcessServer $server, $php_exe)
	{
		parent::__construct($server, 'Ezer_BusinessProcessHandler.php', $php_exe);
	}

	public function request($task)
	{
		$pid = $this->getPid();
		echo "to thread ($pid): $task\n";
		parent::request($task);
	}
	
	public function handleError($result)
	{
		echo "ERROR: $result\n";
	}
	
	public function handleResults($result)
	{
		$result = trim($result);
		$pid = $this->getPid();
		echo "from thread ($pid): $result\n";
		
		if($result == 'onStart')
			$this->ready = true;
		
		if($result == 'onDone')
			$this->done();
	}
	
}

?>