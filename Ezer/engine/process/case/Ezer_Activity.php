<?php

/**
 * @author Tan-Tan
 * @package Engine
 * @subpackage Process.Case
 */
interface Ezer_Activity
{
	public function execute(array $args);
}

/**
 * @author Tan-Tan
 * @package Engine
 * @subpackage Process.Case
 */
abstract class Ezer_AsynchronousActivity implements Ezer_Activity
{
}

/**
 * @author Tan-Tan
 * @package Engine
 * @subpackage Process.Case
 */
abstract class Ezer_SynchronousActivity implements Ezer_Activity
{
}

?>