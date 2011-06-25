<?php

class Ezer_FileLogger implements Ezer_Logger
{
	/**
	 * @var bool
	 */
	protected $stdOut;
	
	/**
	 * @var resource
	 */
	protected $fileHandle;
	
	/**
	 * @param string $path
	 * @param bool $stdOut
	 */
	public function __construct($path, $stdOut = false)
	{
		$this->stdOut = $stdOut;
		$this->fileHandle = fopen($path, 'a');
	}
	
	public function __destruct()
	{
		fclose($this->fileHandle);
	}
	
	public function log($text)
	{
		if($this->stdOut)
			echo "$text\n";
		
		fwrite($this->fileHandle, $text);
	}
}