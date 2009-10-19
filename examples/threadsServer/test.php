<?php
ini_set('max_execution_time', 0);

require_once '../../config/Ezer_Config.php';
require_once 'CountServer.php';
require_once 'CountClient.php';

$config = new Ezer_Config('config.xml');

$server = new ThreadCountServer();

$server->addThreadClient(new ThreadCountClient($server, $config->phpExe));
$server->addThreadClient(new ThreadCountClient($server, $config->phpExe));
$server->addThreadClient(new ThreadCountClient($server, $config->phpExe));

$server->run();
?>