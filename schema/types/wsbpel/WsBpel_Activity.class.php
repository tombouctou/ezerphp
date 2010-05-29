
<?php


// Genarated by Ezer_XsdClasses
// 
// 
// 			
// 				All standard WS-BPEL 2.0 activities in alphabetical order. Basic activities
// 				and structured activities.
// 				Addtional constraints:
// 				- rethrow activity can be used ONLY within a fault handler
// 				  (i.e. "catch" and "catchAll" element)
// 				- compensate or compensateScope activity can be used ONLY
// 				  within a fault handler, a compensation handler or a termination handler
// 			
// 		

/**
 * @author Tan-Tan
 * @package Schema
 * @subpackage Types.wsbpel
 */
class WsBpel_Activity 
{
	private $assign = null;
	private $compensate = null;
	private $compensateScope = null;
	private $empty = null;
	private $exit = null;
	private $extensionActivity = null;
	private $flow = null;
	private $forEach = null;
	private $if = null;
	private $invoke = null;
	private $pick = null;
	private $receive = null;
	private $repeatUntil = null;
	private $reply = null;
	private $rethrow = null;
	private $scope = null;
	private $sequence = null;
	private $throw = null;
	private $validate = null;
	private $wait = null;
	private $while = null;
	private $opaqueActivity = null;


	public function getAssign()
	{
		return $this->assign;
	}
	public function setAssign($assign)
	{
		$this->assign = $assign;
	}
	

	public function getCompensate()
	{
		return $this->compensate;
	}
	public function setCompensate($compensate)
	{
		$this->compensate = $compensate;
	}
	

	public function getCompensateScope()
	{
		return $this->compensateScope;
	}
	public function setCompensateScope($compensateScope)
	{
		$this->compensateScope = $compensateScope;
	}
	

	public function getEmpty()
	{
		return $this->empty;
	}
	public function setEmpty($empty)
	{
		$this->empty = $empty;
	}
	

	public function getExit()
	{
		return $this->exit;
	}
	public function setExit($exit)
	{
		$this->exit = $exit;
	}
	

	public function getExtensionActivity()
	{
		return $this->extensionActivity;
	}
	public function setExtensionActivity($extensionActivity)
	{
		$this->extensionActivity = $extensionActivity;
	}
	

	public function getFlow()
	{
		return $this->flow;
	}
	public function setFlow($flow)
	{
		$this->flow = $flow;
	}
	

	public function getForEach()
	{
		return $this->forEach;
	}
	public function setForEach($forEach)
	{
		$this->forEach = $forEach;
	}
	

	public function getIf()
	{
		return $this->if;
	}
	public function setIf($if)
	{
		$this->if = $if;
	}
	

	public function getInvoke()
	{
		return $this->invoke;
	}
	public function setInvoke($invoke)
	{
		$this->invoke = $invoke;
	}
	

	public function getPick()
	{
		return $this->pick;
	}
	public function setPick($pick)
	{
		$this->pick = $pick;
	}
	

	public function getReceive()
	{
		return $this->receive;
	}
	public function setReceive($receive)
	{
		$this->receive = $receive;
	}
	

	public function getRepeatUntil()
	{
		return $this->repeatUntil;
	}
	public function setRepeatUntil($repeatUntil)
	{
		$this->repeatUntil = $repeatUntil;
	}
	

	public function getReply()
	{
		return $this->reply;
	}
	public function setReply($reply)
	{
		$this->reply = $reply;
	}
	

	public function getRethrow()
	{
		return $this->rethrow;
	}
	public function setRethrow($rethrow)
	{
		$this->rethrow = $rethrow;
	}
	

	public function getScope()
	{
		return $this->scope;
	}
	public function setScope($scope)
	{
		$this->scope = $scope;
	}
	

	public function getSequence()
	{
		return $this->sequence;
	}
	public function setSequence($sequence)
	{
		$this->sequence = $sequence;
	}
	

	public function getThrow()
	{
		return $this->throw;
	}
	public function setThrow($throw)
	{
		$this->throw = $throw;
	}
	

	public function getValidate()
	{
		return $this->validate;
	}
	public function setValidate($validate)
	{
		$this->validate = $validate;
	}
	

	public function getWait()
	{
		return $this->wait;
	}
	public function setWait($wait)
	{
		$this->wait = $wait;
	}
	

	public function getWhile()
	{
		return $this->while;
	}
	public function setWhile($while)
	{
		$this->while = $while;
	}
	

	public function getOpaqueActivity()
	{
		return $this->opaqueActivity;
	}
	public function setOpaqueActivity($opaqueActivity)
	{
		$this->opaqueActivity = $opaqueActivity;
	}
	
}

?>
		