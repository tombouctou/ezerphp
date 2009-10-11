<?php
require_once 'Ezer_ProcessCasePersistance.php';
require_once 'Ezer_Case.php';

/**
 * @author Tan-Tan
 * @package Engine
 * @subpackage Process.Logic
 */
class Ezer_XmlCasePersistance implements Ezer_ProcessCasePersistance
{
	private $cases = array();
	private $path = array();
	
	public function __construct($path)
	{
		$this->path = $path;
	}

	private function parseDir($path)
	{
		$dir = dir($path);
		
		$files = array();
		while (false !== ($entry = $dir->read())) 
		{
			if($entry == '.' || $entry == '..')
				continue;

			if(is_dir("$path/$entry"))
				$this->parseDir("$path/$entry");
			
			if(preg_match('/.+\.pbc/', $entry))
				$files[] = "$path/$entry";
		}
		$dir->close();
		
		foreach($files as $file)
		{
			$this->parseFile($file);
			$archive = str_replace('.pbc', '.arc', $file);
			rename($file, $archive);
		}
	}
	
	private function mapConfig(Ezer_Config $config)
	{
		$case = new Ezer_Case($config->identifier);
		$case->priority = $config->priority;
		
		foreach($config->variables as $variable)
			$case->variables[$variable->name] = $variable->value;
			
		return $case;
	}
	
	private function parseFile($file)
	{
		$config = new Ezer_Config($file);
		$this->cases[] = $this->mapConfig($config);
	}
	
	public function getCases()
	{
		$this->cases = array();
		$this->parseDir($this->path);
		return $this->cases;
	}
}

?>