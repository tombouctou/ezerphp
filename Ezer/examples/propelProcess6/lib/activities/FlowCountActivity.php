<?php

/**
 * @author Tan-Tan
 * @package Examples
 * @subpackage Process
 */
class FlowCountActivity extends Ezer_AsynchronousActivity
{
	public function execute(array $args)
	{
		$sleep = 3;
		
		$prefix = '';
		foreach($args as $arg)
		{
			if(!is_numeric($arg))
			{
				$this->log($arg);
				$prefix = $arg;
				break;
			}
		}
			
		foreach($args as $arg)
		{
			if(!is_numeric($arg))
				continue;
				
			$arg = intval($arg);
			for($i = 1; $i <= $arg; $i++)
			{
				$this->log("$prefix: $i");
//				$this->progress(intval(100 * ($i / $arg)));
				sleep($sleep);
			}
		}
			
		return true;
	}
}
