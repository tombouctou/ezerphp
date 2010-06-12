<?php
error_reporting(E_ALL);

require_once 'bootstrap.php';

$config = Ezer_Config::createFromPath('config.xml');

Propel::setConfiguration($config->database->toArray());
Propel::initialize();

// insert process

$variable1 = new Ezer_Variable();
$variable1->setName('hello');
$variable1->setType('string');

$variable2 = new Ezer_Variable();
$variable2->setName('bye');
$variable2->setType('string');

$process = new Ezer_PropelBusinessProcess();
$process->setName('HelloWorld');
$process->setStatus(Ezer_IntStep::STEP_STATUS_ACTIVE);
$process->addVariable($variable1);
$process->addVariable($variable2);
$process->save();

$sequence = new Ezer_PropelSequence();
$sequence->setName('main');
$sequence->setStatus(Ezer_IntStep::STEP_STATUS_ACTIVE);
$sequence->setContainer($process);
$sequence->save();

$activity = new Ezer_PropelActivityStep();
$activity->setName('Hello World');
$activity->setStatus(Ezer_IntStep::STEP_STATUS_ACTIVE);
$activity->setClass('SayActivity');
$activity->setArgs(array('hello'));
$activity->setContainer($sequence, 0);
$activity->save();

$copy = new Ezer_AssignStepCopy();
$copy->from = new Ezer_AssignStepFromAttribute('bye');
$copy->to = new Ezer_AssignStepToAttribute('hello');

$assign = new Ezer_PropelAssignStep();
$assign->setName('Assign');
$assign->setStatus(Ezer_IntStep::STEP_STATUS_ACTIVE);
$assign->addCopy($copy);
$assign->setContainer($sequence, 1);
$assign->save();

$activity = new Ezer_PropelActivityStep();
$activity->setName('Googbye');
$activity->setStatus(Ezer_IntStep::STEP_STATUS_ACTIVE);
$activity->setClass('SayActivity');
$activity->setArgs(array('hello', 'bye'));
$activity->setContainer($sequence, 2);
$activity->save();

