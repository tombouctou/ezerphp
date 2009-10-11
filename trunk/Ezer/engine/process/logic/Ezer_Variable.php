<?php
require_once 'Ezer_Sequence.php';

/**
 * @author Tan-Tan
 * @package Engine
 * @subpackage Process.Logic
 */
class Ezer_Variable extends Ezer_Loadable
{
	public $id;
	protected $name;
	
	/**
	 * @mandatory false
	 */
	protected $type;
	
	public function __construct($id)
	{
		$this->id = $id;
	}
}

?>