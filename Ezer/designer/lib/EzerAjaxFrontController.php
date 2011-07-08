<?php
class EzerAjaxFrontController
{
	public static function run($uri)
	{
		$request = null;
		if(!preg_match('/\/ajax\/index\.php\/service\/(?P<service>[^\/]+)\/?(?P<action>[^\/]+)?/', $uri, $request))
			die('Service and action not specified');
			
		$controllerName = ucfirst($request['service']);
		$controllerClass = $controllerName . 'Controller';
		
		$actionName = ucfirst(isset($request['action']) ? $request['action'] : 'index');
		$actionMethod = $actionName . 'Action';
		
//		echo "controllerClass [$controllerClass]<br/>\n";
//		echo "actionMethod [$actionMethod]<br/>\n";

		if(!class_exists($controllerClass) || !is_subclass_of($controllerClass, 'EzerAjaxController'))
			die("Service [$controllerName] not found");
			
		$controller = new $controllerClass();
		if(!method_exists($controller, $actionMethod))
			die("Action [{$controllerName}.{$actionName}] not found");
			
		$arguments = array();
		try
		{
			$method = new ReflectionMethod($controllerClass, $actionMethod);
		}
		catch(Exception $e)
		{
			echo "Action not found [$controllerName.$actionName]";
			return;
		}
		
		$parameters = $method->getParameters();
		foreach($parameters as $parameter)
		{
			$arguments[$parameter->name] = self::getArgument($parameter);
		}
		
		$results = $method->invokeArgs($controller, $arguments);
		echo json_encode($results);
	}
	
	private static function getArgumentType(ReflectionParameter $parameter)
	{
		$comment = $parameter->getDeclaringFunction()->getDocComment();
		if(!$comment)
			return null;
			
		$matches = null;
		if(!preg_match("/@param\\s+([^\\s]+)\\s+\\\${$parameter->name}/", $comment, $matches))
			return null;
		
		return $matches[1];
	}
	
	private static function getArgument(ReflectionParameter $parameter)
	{
		if(isset($_REQUEST[$parameter->name]))
		{
			if($parameter->isArray())
				return $_REQUEST[$parameter->name];
				
			$type = self::getArgumentType($parameter);
			if(!class_exists($type))
				throw new Exception("Type not found for attribute [$parameter->name]");
				
			$object = new $type();
			if(is_array($_REQUEST[$parameter->name]))
			{
				foreach($_REQUEST[$parameter->name] as $attribute => $value)
					$object->$attribute = $value;
			}
			return $object;
		}
		
		if($parameter->isDefaultValueAvailable())
			return $parameter->getDefaultValue();
			
		if($parameter->allowsNull())
			return null;
					
		if($parameter->isArray())
			return array();
			
		$type = self::getArgumentType($parameter);
		if(!class_exists($type))
			throw new Exception("Type not found for attribute [$parameter->name]");
			
		return new $type();
	}
}