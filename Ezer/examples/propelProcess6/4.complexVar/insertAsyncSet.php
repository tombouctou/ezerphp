<?php
error_reporting(E_ALL);

require_once 'bootstrap.php';

$config = Ezer_Config::createFromPath('config.xml');

Propel::setConfiguration($config->database->toArray());
Propel::initialize();

// insert process

$variable1 = new Ezer_Variable();
$variable1->setName('title');
$variable1->setType('string');

$variable2 = new Ezer_Variable();
$variable2->setName('counter');

$partTitle = new Ezer_Variable();
$partTitle->setName('title');
$partTitle->setType('string');
$variable2->parts[] = $partTitle;

$partCounts = new Ezer_Variable();
$partCounts->setName('counts');
$partCounts->setType('array');
$variable2->parts[] = $partCounts;

$partArray = new Ezer_Variable();
$partCounts->parts[] = $partArray;

$partStart = new Ezer_Variable();
$partStart->setName('start');
$partStart->setType('int');
$partArray->parts[] = $partStart;

$partStop = new Ezer_Variable();
$partStop->setName('stop');
$partStop->setType('int');
$partArray->parts[] = $partStop;

$process = new Ezer_PropelBusinessProcess();
$process->setName('Complex Async Set');
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
$activity->setName('First count');
$activity->setStatus(Ezer_IntStep::STEP_STATUS_ACTIVE);
$activity->setClass('ComplexCountActivity');
$activity->setArgs(array('counter'));
$activity->setContainer($sequence, 0);
$activity->save();

$activity = new Ezer_PropelActivityStep();
$activity->setName('Async Set');
$activity->setStatus(Ezer_IntStep::STEP_STATUS_ACTIVE);
$activity->setClass('AsyncSetActivity');
$activity->setContainer($sequence, 1);
$activity->save();

$activity = new Ezer_PropelActivityStep();
$activity->setName('Second count');
$activity->setStatus(Ezer_IntStep::STEP_STATUS_ACTIVE);
$activity->setClass('ComplexCountActivity');
$activity->setArgs(array('counter'));
$activity->setContainer($sequence, 2);
$activity->save();

