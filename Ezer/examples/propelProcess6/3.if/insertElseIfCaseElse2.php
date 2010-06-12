<?php
error_reporting(E_ALL);

require_once 'bootstrap.php';

$config = Ezer_Config::createFromPath('config.xml');

Propel::setConfiguration($config->database->toArray());
Propel::initialize();

// find process
$process = Ezer_PropelStepPeer::retrieveProcessByName('Else If');

// insert case
$variables = array(
	'condition' => 5,
	'expression' => 'true',
	'beginMessage' => 'Hi Tan-Tan',
	'endMessage' => 'Bye Tan-Tan',
	'ifMessage' => 'Condition is TRUE',
	'elseMessage' => 'All condition are FALSE',
	'elseIfMessage1' => 'Else 1 condition is TRUE',
	'elseIfMessage2' => 'Else 2 condition is TRUE',
);
$case = new Ezer_PropelCase();
$case->setProcessId($process->getId());
$case->setPriority(1);
$case->setStatus(Ezer_IntStep::STEP_STATUS_ACTIVE);
$case->setVariables($variables);
$case->save();

