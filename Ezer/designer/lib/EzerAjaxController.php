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
	 * @param BaseObject $objects
	 * @param array $columns
	 * @return stdClass
	 */
	protected function toObject(BaseObject $object, array $columns)
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
		return $stdClass;
	}
}