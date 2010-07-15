<?php

class Ezer_Log
{
	/**
	 * @var Ezer_Logger
	 */
	private static $logger;
	
	public static function setLogger(Ezer_Logger $logger)
	{
		self::$logger = $logger;
	}
	
	public static function log($text)
	{
		if(self::$logger)
			self::$logger->log($text);
	}
	
	public static function debug($text)
	{
		self::log($text);
	}
	
	public static function err($text)
	{
		self::log($text);
	}
}