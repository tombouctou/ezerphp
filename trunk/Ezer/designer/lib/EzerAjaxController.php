<?php
class EzerAjaxController
{
	/**
	 * @param array $objects
	 * @param array $columns
	 * @return array<stdClass>
	 */
	protected function toArray(array $objects, array $columns)
	{
		$ret = array();
		foreach($objects as $object)
			$ret[] = $this->toObject($object, $columns);
			
		return $ret;
	}

	/**
	 * @param Ezer_IntObject $objects
	 * @param array $columns
	 * @return stdClass
	 */
	protected function toObject(Ezer_IntObject $object, array $columns)
	{
		$matches = null;
		if(!preg_match('/^Ezer_Propel(.+)$/', get_class($object), $matches))
			return null;
			
		$stdClass = new stdClass();
		$stdClass->objectType = $matches[1];
		
		foreach($columns as $column)
		{
			if($column == 'data')
				continue;
				
			$getter = "get{$column}";
			$stdClass->$column = $object->$getter();
		}
		
		$customFields = $object->getCustomFields();
		foreach($customFields as $customField => $customGetter)
		{
			if(is_numeric($customField))
				$customField = $customGetter;
				
			$getter = "get{$customGetter}";
			$value = $object->$getter();
			if($value instanceof Ezer_IntObject)
			{
				$attributePeer = $value->getPeer();
				$attributeColumns = $attributePeer->getFieldNames(BasePeer::TYPE_STUDLYPHPNAME);
				$value = $this->toObject($value, $attributeColumns);
			}
			$stdClass->$customField = $value;
		}
		
		return $stdClass;
	}
}