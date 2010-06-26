<?php
error_reporting(E_ALL);

require_once 'bootstrap.php';

$config = Ezer_Config::createFromPath('config.xml');

Propel::setConfiguration($config->database->toArray());
Propel::initialize();

// insert process

$variable1 = new Ezer_Variable();
$variable1->setName('message');
$variable1->setType('string');

$variable2 = new Ezer_Variable();
$variable2->setName('users');
$variable2->setType('array');

$process = new Ezer_PropelBusinessProcess();
$process->setName('Foreach Serial');
$process->setStatus(Ezer_IntStep::STEP_STATUS_ACTIVE);
$process->addVariable($variable1);
$process->addVariable($variable2);
$process->save();

$sequence = new Ezer_PropelSequence();
$sequence->setName('main');
$sequence->setStatus(Ezer_IntStep::STEP_STATUS_ACTIVE);
$sequence->setContainer($process);
$sequence->save();

$items = new Ezer_AssignStepFromAttribute('users');

$foreach = new Ezer_PropelForeach();
$foreach->setName('Foreach');
$foreach->setStatus(Ezer_IntStep::STEP_STATUS_ACTIVE);
$foreach->setOrderType(Ezer_IntForeach::TYPE_SERIAL);
$foreach->setArg($items);
$foreach->setContainer($sequence, 0);
$foreach->save();

$activity = new Ezer_PropelActivityStep();
$activity->setName('Say Message');
$activity->setStatus(Ezer_IntStep::STEP_STATUS_ACTIVE);
$activity->setClass('HelloActivity');
$activity->setArgs(array('item', 'message'));
$activity->setContainer($foreach);
$activity->save();
