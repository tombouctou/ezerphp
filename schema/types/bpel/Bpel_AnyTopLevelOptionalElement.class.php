
<?php


// Genarated by Ezer_XsdClasses
// 
// 
//       
//       Any top level optional element allowed to appear more then once - any child of definitions element except wsdl:types. Any extensibility element is allowed in any place.
//       
//     

/**
 * @author Tan-Tan
 * @package Schema
 * @subpackage Types.bpel
 */
class Bpel_AnyTopLevelOptionalElement 
{
	private $import = null;
	private $types = null;
	private $message = null;
	private $portType = null;
	private $binding = null;
	private $service = null;


	public function getImport()
	{
		return $this->import;
	}
	public function setImport(Bpel_TImport $import)
	{
		$this->import = $import;
	}
	

	public function getTypes()
	{
		return $this->types;
	}
	public function setTypes(Bpel_TTypes $types)
	{
		$this->types = $types;
	}
	

	public function getMessage()
	{
		return $this->message;
	}
	public function setMessage(Bpel_TMessage $message)
	{
		$this->message = $message;
	}
	

	public function getPortType()
	{
		return $this->portType;
	}
	public function setPortType(Bpel_TPortType $portType)
	{
		$this->portType = $portType;
	}
	

	public function getBinding()
	{
		return $this->binding;
	}
	public function setBinding(Bpel_TBinding $binding)
	{
		$this->binding = $binding;
	}
	

	public function getService()
	{
		return $this->service;
	}
	public function setService(Bpel_TService $service)
	{
		$this->service = $service;
	}
	
}

?>
		