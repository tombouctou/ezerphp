<?php
ini_set('max_execution_time', 0);
chdir(dirname(__FILE__));

require_once 'bootstrap.php';

$config = Ezer_Config::createFromPath('config.xml');
$dbConfig = $config->database->toArray();

$server = new Ezer_BusinessProcessServer(new Ezer_PropelLogicPersistance($dbConfig));
$server->addCasePersistance(new Ezer_PropelCasePersistance($dbConfig));

$server->addThreadClient(new Ezer_BusinessProcessClient($server, $config->phpExe));
$server->addThreadClient(new Ezer_BusinessProcessClient($server, $config->phpExe));
$server->addThreadClient(new Ezer_BusinessProcessClient($server, $config->phpExe));

$server->run();
