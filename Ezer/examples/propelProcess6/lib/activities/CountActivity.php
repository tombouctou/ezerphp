<?php

/**
 * @author Tan-Tan
 * @package Examples
 * @subpackage Process
 */
class CountActivity extends Ezer_AsynchronousActivity
{
	public function execute(array $args)
	{
		foreach($args as $arg)
		{
			if(!is_numeric($arg))
			{
				$this->log($arg);
				continue;
			}
			
			$arg = intval($arg);
			for($i = 1; $i <= $arg; $i++)
			{
				$this->log("counting $i");
				$this->progress(intval(100 * ($i / $arg)));
				sleep(1);
			}
		}
			
		return true;
	}
}
