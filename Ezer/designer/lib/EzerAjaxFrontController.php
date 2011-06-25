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
			
		$results = $controller->$actionMethod();
		echo json_encode($results);
	}
}