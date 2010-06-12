<?php
error_reporting(E_ALL);

require_once 'bootstrap.php';

$config = Ezer_Config::createFromPath('config.xml');

Propel::setConfiguration($config->database->toArray());
Propel::initialize();

// find process
$process = Ezer_PropelStepPeer::retrieveProcessByName('AsyncHelloWorld');

// insert case
$variables = array(
	'firstCount' => 2,
	'secondCount' => 2,
	'message1' => 'A 111',
	'message2' => 'A 222',
	'message3' => 'A 333'
);
$case = new Ezer_PropelCase();
$case->setProcessId($process->getId());
$case->setPriority(1);
$case->setStatus(Ezer_IntStep::STEP_STATUS_ACTIVE);
$case->setVariables($variables);
$case->save();

