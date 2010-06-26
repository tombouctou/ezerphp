<?php

/**
 * @author Tan-Tan
 * @package Examples
 * @subpackage Process
 */
class HelloActivity extends Ezer_AsynchronousActivity
{
	public function execute(array $args)
	{
		$user = $args['item'];
		$hellow = $args['message'];
		
		for($i = 0; $i < 6; $i++)
		{
			$this->log("$i. $hellow $user\n");
			sleep(3);
		}
			
		return true;
	}
}
