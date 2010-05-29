<?php
error_reporting(E_ALL);
ini_set('max_execution_time', 0);

require_once '../../config/Ezer_Config.php';
require_once '../../engine/process/Ezer_BusinessProcessServer.php';
require_once '../../engine/process/logic/xml/Ezer_XmlLogicPersistance.php';
require_once '../../engine/process/case/Ezer_XmlCasePersistance.php';

$config = new Ezer_Config('config.xml');

$server = new Ezer_BusinessProcessServer(new Ezer_XmlLogicPersistance($config->logicPath));

$server->addCasePersistance(new Ezer_XmlCasePersistance($config->casesPath));

$server->addThreadClient(new Ezer_BusinessProcessClient($server, $config->phpExe));
$server->addThreadClient(new Ezer_BusinessProcessClient($server, $config->phpExe));
$server->addThreadClient(new Ezer_BusinessProcessClient($server, $config->phpExe));

$server->run();
?>