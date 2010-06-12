<?php
error_reporting(E_ALL);

require_once 'bootstrap.php';

$config = Ezer_Config::createFromPath('config.xml');

Propel::setConfiguration($config->database->toArray());
Propel::initialize();

// insert process

$variable1 = new Ezer_Variable();
$variable1->setName('firstCount');
$variable1->setType('int');

$variable2 = new Ezer_Variable();
$variable2->setName('secondCount');
$variable2->setType('int');

$variable3 = new Ezer_Variable();
$variable3->setName('message1');
$variable3->setType('string');

$variable4 = new Ezer_Variable();
$variable4->setName('message2');
$variable4->setType('string');

$variable5 = new Ezer_Variable();
$variable5->setName('message2');
$variable5->setType('string');

$process = new Ezer_PropelBusinessProcess();
$process->setName('AsyncHelloWorld');
$process->setStatus(Ezer_IntStep::STEP_STATUS_ACTIVE);
$process->addVariable($variable1);
$process->addVariable($variable2);
$process->addVariable($variable3);
$process->addVariable($variable4);
$process->addVariable($variable5);
$process->save();

$sequence = new Ezer_PropelSequence();
$sequence->setName('main');
$sequence->setStatus(Ezer_IntStep::STEP_STATUS_ACTIVE);
$sequence->setContainer($process);
$sequence->save();

$activity = new Ezer_PropelActivityStep();
$activity->setName('First Count');
$activity->setStatus(Ezer_IntStep::STEP_STATUS_ACTIVE);
$activity->setClass('CountActivity');
$activity->setArgs(array('message1', 'firstCount'));
$activity->setContainer($sequence, 0);
$activity->save();

$activity = new Ezer_PropelActivityStep();
$activity->setName('Second Count');
$activity->setStatus(Ezer_IntStep::STEP_STATUS_ACTIVE);
$activity->setClass('CountActivity');
$activity->setArgs(array('message2', 'firstCount'));
$activity->setContainer($sequence, 1);
$activity->save();

$activity = new Ezer_PropelActivityStep();
$activity->setName('Message Count');
$activity->setStatus(Ezer_IntStep::STEP_STATUS_ACTIVE);
$activity->setClass('CountActivity');
$activity->setArgs(array('message3'));
$activity->setContainer($sequence, 1);
$activity->save();
