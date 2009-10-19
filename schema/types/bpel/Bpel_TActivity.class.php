
<?php
require_once dirname(__FILE__) . '/Bpel_TExtensibleElements.class.php';

// Genarated by Ezer_XsdClasses
// 

/**
 * @author Tan-Tan
 * @package Schema
 * @subpackage Types.bpel
 */
class Bpel_TActivity extends Bpel_TExtensibleElements
{
	private $target = null;
	private $source = null;
	private $name = null;
	private $joinCondition = null;
	private $suppressJoinFailure = null;


	public function getTarget()
	{
		return $this->target;
	}
	public function setTarget(Bpel_TTarget $target)
	{
		$this->target = $target;
	}
	

	public function getSource()
	{
		return $this->source;
	}
	public function setSource(Bpel_TSource $source)
	{
		$this->source = $source;
	}
	

	public function getName()
	{
		return $this->name;
	}
	public function setName($name)
	{
		$this->name = $name;
	}
	

	public function getJoinCondition()
	{
		return $this->joinCondition;
	}
	public function setJoinCondition(Bpel_TBoolean_expr $joinCondition)
	{
		$this->joinCondition = $joinCondition;
	}
	

	public function getSuppressJoinFailure()
	{
		return $this->suppressJoinFailure;
	}
	public function setSuppressJoinFailure(Bpel_TBoolean $suppressJoinFailure)
	{
		$this->suppressJoinFailure = $suppressJoinFailure;
	}
	
}

?>
		