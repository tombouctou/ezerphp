<?php

/**
 * @author Tan-Tan
 * @package Examples
 * @subpackage Process
 */
class CountActivity extends Ezer_SynchronousActivity
{
	public function execute(array $args)
	{
		$counter = $args['counter'];
		$title = $counter['title'];
		
		echo "$title\n";
		foreach($counter['counts'] as $count)
		{
			$start = $count['start'];
			$stop = $count['stop'];
			
			for($i = $start; $i <= $stop; $i++)
				echo "counting $i\n";
		}
			
		return true;
	}
}
