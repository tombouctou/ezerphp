<?php
error_reporting(E_ALL);

require_once 'bootstrap.php';

$config = Ezer_Config::createFromPath('config.xml');

Propel::setConfiguration($config->database->toArray());
Propel::initialize();

// find process
$process = Ezer_PropelStepPeer::retrieveProcessByName('HelloWorld');

// insert case
$variables = array(
	'hello' => 'Hi Tan-Tan',
	'bye' => 'Goodbye Johnathan'
);
$case = new Ezer_PropelCase();
$case->setProcessId($process->getId());
$case->setPriority(1);
$case->setStatus(Ezer_IntStep::STEP_STATUS_ACTIVE);
$case->setVariables($variables);
$case->save();

