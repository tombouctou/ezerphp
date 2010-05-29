<?php
/**
 * @author Tan-Tan
 * @package Examples
 * @subpackage Process
 */
class SayActivity extends Ezer_SynchronousActivity
{
	public function execute(array $args)
	{
		foreach($args as $arg)
			echo "$arg\n";
			
		return true;
	}
}
