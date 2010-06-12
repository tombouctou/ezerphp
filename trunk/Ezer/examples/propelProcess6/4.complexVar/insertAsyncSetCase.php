<?php
error_reporting(E_ALL);

require_once 'bootstrap.php';

$config = Ezer_Config::createFromPath('config.xml');

Propel::setConfiguration($config->database->toArray());
Propel::initialize();

// find process
$process = Ezer_PropelStepPeer::retrieveProcessByName('Complex Async Set');

// insert case
$variables = array(
	'title' => 'New Title',
	'counter' => array(
		'title' => 'Original Title',
		'counts' => array(
			array('start' => 6, 'stop' => 10),
			array('start' => 9, 'stop' => 12)
		)
	)
);
$case = new Ezer_PropelCase();
$case->setProcessId($process->getId());
$case->setPriority(1);
$case->setStatus(Ezer_IntStep::STEP_STATUS_ACTIVE);
$case->setVariables($variables);
$case->save();

