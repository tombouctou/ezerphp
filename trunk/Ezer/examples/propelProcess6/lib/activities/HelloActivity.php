<?php

/**
 * @author Tan-Tan
 * @package Examples
 * @subpackage Process
 */
class HelloActivity extends Ezer_SynchronousActivity
{
	public function execute(array $args)
	{
		$user = $args['item'];
		$hellow = $args['hellow'];
		echo "$hellow $user\n";
			
		return true;
	}
}
