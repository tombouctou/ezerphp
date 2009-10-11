<?php
require_once dirname(__FILE__) . '/../case/Ezer_BusinessProcessInstance.php';
require_once 'Ezer_Sequence.php';

/**
 * @author Tan-Tan
 * @package Engine
 * @subpackage Process.Logic
 */
class Ezer_BusinessProcess extends Ezer_Loadable
{
	public $id;
	
	protected $sequence;
	protected $name;
	protected $variables;

	public function __set($name, $value) 
	{
		switch($name)
		{
			case 'import':
				require_once $value;
				break;
				
			default:
				parent::__set($name, $value);
				break;
		}
	}
	
	public function __construct($id)
	{
		$this->id = $id;
	}
	
	public function createInstance(array $variables)
	{
		return new Ezer_BusinessProcessInstance($variables, $this);
	}
	
	public function getName()
	{
		return $this->name;
	}
	
	public function getSequence()
	{
		return $this->sequence;
	}
}

?>