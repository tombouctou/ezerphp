<?php
error_reporting(E_ALL);

require_once 'bootstrap.php';

$config = Ezer_Config::createFromPath('config.xml');

Propel::setConfiguration($config->database->toArray());
Propel::initialize();

// find process
$process = Ezer_PropelStepPeer::retrieveProcessByName('If Else');

// insert case
$variables = array(
	'condition' => 5,
	'expression' => 'true',
	'beginMessage' => 'Hi Tan-Tan',
	'endMessage' => 'Bye Tan-Tan',
	'ifMessage' => 'Condition is TRUE',
	'elseMessage' => 'Condition is FALSE'
);
$case = new Ezer_PropelCase();
$case->setProcessId($process->getId());
$case->setPriority(1);
$case->setStatus(Ezer_IntStep::STEP_STATUS_ACTIVE);
$case->setVariables($variables);
$case->save();

