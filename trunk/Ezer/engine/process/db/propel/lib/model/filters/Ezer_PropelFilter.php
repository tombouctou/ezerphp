<?php


/**
 * @package    lib.filter
 */
abstract class Ezer_PropelFilter 
{
	const EQUAL = "Equal";
	const IN = "In";
	const NOT_IN = "NotIn";
	const LIKE = "Like";
	const NOT_LIKE = "NotLike";
	
	protected static $typeMap = array(
		self::EQUAL => Criteria::EQUAL,
		self::IN => Criteria::IN,
		self::NOT_IN => Criteria::NOT_IN,
		self::LIKE => Criteria::LIKE,
		self::NOT_LIKE => Criteria::NOT_LIKE,
	);
	
	/**
	 * @var Ezer_IntPeer
	 */
	protected $peer;
	
	/**
	 * List of valid fields
	 * @var array
	 */
	protected $allowedFields;
	
	/**
	 * @var Criteria
	 */
	protected $criteria;
	
	/**
	 * @param Ezer_IntPeer $peer
	 */
	public function __construct(Ezer_IntPeer $peer)
	{
		$this->peer = $peer;
		$this->allowedFields = $peer->getFieldNames();
		$this->criteria = new Criteria();
	}
	
	public function execute(Ezer_PropelPager $pager = null)
	{
		return $this->peer->doSelect($this->criteria);
	}
	
	protected static function translateType($type)
	{
		if(!isset(self::$typeMap[$type]))
			throw new Exception("Condition type [$type] not found");
			
		return self::$typeMap[$type];
	}
	
	protected function addCondition($field, $value, $type = self::EQUAL)
	{
		$columnName = $this->peer->translateFieldName($field, BasePeer::TYPE_PHPNAME, BasePeer::TYPE_COLNAME);
		$criteriaType = self::translateType($type);
		$this->criteria->add($columnName, $value, $criteriaType);
	}
	
	public function __set($field, $conditions)
	{
		if(is_array($conditions))
		{
			foreach($conditions as $type => $value)
			{
				if($type == self::IN || $type == self::NOT_IN)
					$value = explode(',', $value);
					
				$this->addCondition($field, $value, $type);
			}
		}
		else
		{
			$this->addCondition($field, $conditions);
		}
	}
}
