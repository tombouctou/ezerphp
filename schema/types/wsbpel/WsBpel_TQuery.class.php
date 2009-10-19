
<?php


// Genarated by Ezer_XsdClasses
// 

/**
 * @author Tan-Tan
 * @package Schema
 * @subpackage Types.wsbpel
 */
class WsBpel_TQuery 
{
	private $queryLanguage = null;
	private $opaque = null;


	public function getQueryLanguage()
	{
		return $this->queryLanguage;
	}
	public function setQueryLanguage(WsBpel_AnyURI $queryLanguage)
	{
		$this->queryLanguage = $queryLanguage;
	}
	

	public function getOpaque()
	{
		return $this->opaque;
	}
	public function setOpaque(WsBpel_TOpaqueBoolean $opaque)
	{
		$this->opaque = $opaque;
	}
	
}

?>
		