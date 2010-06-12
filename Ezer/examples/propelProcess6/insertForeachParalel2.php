<?php
error_reporting(E_ALL);

require_once 'bootstrap.php';

$config = Ezer_Config::createFromPath('config.xml');

Propel::setConfiguration($config->database->toArray());
Propel::initialize();

// insert process

$variable1 = new Ezer_Variable();
$variable1->setName('users');
$variable1->setType('array');

$variable2 = new Ezer_Variable();
$variable2->setName('hellow');
$variable2->setType('string');

$process = new Ezer_PropelBusinessProcess();
$process->setName('HelloUsers');
$process->setStatus(Ezer_IntStep::STEP_STATUS_ACTIVE);
$process->addVariable($variable1);
$process->addVariable($variable2);
$process->save();

$foreach = new Ezer_PropelForeach();
$foreach->setName('foreachUser');
$foreach->setStatus(Ezer_IntStep::STEP_STATUS_ACTIVE);
$foreach->setContainer($process);
$foreach->save();

$activity = new Ezer_PropelActivityStep();
$activity->setName('helow user');
$activity->setStatus(Ezer_IntStep::STEP_STATUS_ACTIVE);
$activity->setClass('HelloActivity');
$activity->setArgs(array('hello', 'item'));
$activity->setContainer($foreach);
$activity->save();

