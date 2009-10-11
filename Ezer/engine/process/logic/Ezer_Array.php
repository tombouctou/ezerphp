<?php
require_once 'Ezer_Loadable.php';

/**
 * @author Tan-Tan
 * @package Engine
 * @subpackage Process.Logic
 */
class Ezer_Array extends ArrayObject
{
	public $id;
	private $data;
	
	public function __construct($id = 0)
	{
		$this->id = $id;
	}
	
	public function add($value)
	{
		$this[] = $value;
	}
	
	public function __set($name, $value)
	{
		$this[] = $value;
	}
}

?>