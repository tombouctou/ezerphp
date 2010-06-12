<?php
error_reporting(E_ALL);

require_once 'bootstrap.php';

$config = Ezer_Config::createFromPath('config.xml');

Propel::setConfiguration($config->database->toArray());
Propel::initialize();

// find process
$process = Ezer_PropelStepPeer::retrieveProcessByName('Flow');

// insert case
$variables = array(
	'count' => 5,
	'left1' => 'Left1',
	'left2' => 'Left2',
	'right1' => 'Right1',
	'right2' => 'Right2',
	'before' => 'Before',
	'after' => 'After',
);
$case = new Ezer_PropelCase();
$case->setProcessId($process->getId());
$case->setPriority(1);
$case->setStatus(Ezer_IntStep::STEP_STATUS_ACTIVE);
$case->setVariables($variables);
$case->save();

