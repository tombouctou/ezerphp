<?php
ini_set('max_execution_time', 0);

require_once 'bootstrap.php';

$config = Ezer_Config::createFromPath('config.xml');

$server = new SocketCountServer();

$server->addThreadClient(new SocketCountClient($server, $config->phpExe));
$server->addThreadClient(new SocketCountClient($server, $config->phpExe));
$server->addThreadClient(new SocketCountClient($server, $config->phpExe));

$server->run();
