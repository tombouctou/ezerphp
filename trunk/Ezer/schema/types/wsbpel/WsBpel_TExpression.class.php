
<?php


// Genarated by Ezer_XsdClasses
// 

/**
 * @author Tan-Tan
 * @package Schema
 * @subpackage Types.wsbpel
 */
class WsBpel_TExpression 
{
	private $expressionLanguage = null;
	private $opaque = null;


	public function getExpressionLanguage()
	{
		return $this->expressionLanguage;
	}
	public function setExpressionLanguage(WsBpel_AnyURI $expressionLanguage)
	{
		$this->expressionLanguage = $expressionLanguage;
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
		