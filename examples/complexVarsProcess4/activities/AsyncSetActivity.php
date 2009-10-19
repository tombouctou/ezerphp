<?php
require_once '../../engine/process/case/Ezer_Activity.php';

/**
 * @author Tan-Tan
 * @package Examples
 * @subpackage Process
 */
class AsyncSetActivity extends Ezer_AsynchronousActivity
{
	public function execute(array $args)
	{
//		$this->log("AsyncSetActivity excuted");
		$this->setVariable('counter/title', 'New title - set from child process');
		return true;
	}
}
?>