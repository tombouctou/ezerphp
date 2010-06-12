<?php
error_reporting(E_ALL);

require_once 'bootstrap.php';

$config = Ezer_Config::createFromPath('config.xml');

Propel::setConfiguration($config->database->toArray());
Propel::initialize();

// find process
$process = Ezer_PropelStepPeer::retrieveProcessByName('If');

// insert case
$variables = array(
	'condition' => 3,
	'expression' => 'false',
	'beginMessage' => 'Hi Tan-Tan',
	'endMessage' => 'Bye Tan-Tan',
	'ifMessage' => 'Condition is TRUE'
);
$case = new Ezer_PropelCase();
$case->setProcessId($process->getId());
$case->setPriority(1);
$case->setStatus(Ezer_IntStep::STEP_STATUS_ACTIVE);
$case->setVariables($variables);
$case->save();

