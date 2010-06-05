<?php
ini_set('max_execution_time', 0);

require_once 'bootstrap.php';

$config = Ezer_Config::createFromPath('config.xml');

$server = new ThreadCountServer();

$server->addThreadClient(new ThreadCountClient($server, $config->phpExe));
$server->addThreadClient(new ThreadCountClient($server, $config->phpExe));
$server->addThreadClient(new ThreadCountClient($server, $config->phpExe));

$server->run();
