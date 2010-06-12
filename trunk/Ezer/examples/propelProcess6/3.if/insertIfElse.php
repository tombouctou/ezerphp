<?php
error_reporting(E_ALL);

require_once 'bootstrap.php';

$config = Ezer_Config::createFromPath('config.xml');

Propel::setConfiguration($config->database->toArray());
Propel::initialize();

// insert process

$variable1 = new Ezer_Variable();
$variable1->setName('condition');
$variable1->setType('int');

$variable2 = new Ezer_Variable();
$variable2->setName('expression');
$variable2->setType('boolean');

$variable3 = new Ezer_Variable();
$variable3->setName('beginMessage');
$variable3->setType('string');

$variable4 = new Ezer_Variable();
$variable4->setName('endMessage');
$variable4->setType('string');

$variable5 = new Ezer_Variable();
$variable5->setName('ifMessage');
$variable5->setType('string');

$variable6 = new Ezer_Variable();
$variable6->setName('elseMessage');
$variable6->setType('string');

$process = new Ezer_PropelBusinessProcess();
$process->setName('If Else');
$process->setStatus(Ezer_IntStep::STEP_STATUS_ACTIVE);
$process->addVariable($variable1);
$process->addVariable($variable2);
$process->addVariable($variable3);
$process->addVariable($variable4);
$process->addVariable($variable5);
$process->addVariable($variable6);
$process->save();

$sequence = new Ezer_PropelSequence();
$sequence->setName('main');
$sequence->setStatus(Ezer_IntStep::STEP_STATUS_ACTIVE);
$sequence->setContainer($process);
$sequence->save();

$activity = new Ezer_PropelActivityStep();
$activity->setName('Begin Message');
$activity->setStatus(Ezer_IntStep::STEP_STATUS_ACTIVE);
$activity->setClass('SayActivity');
$activity->setArgs(array('beginMessage'));
$activity->setContainer($sequence, 0);
$activity->save();


$if = new Ezer_PropelIf();
$if->setName('If');
$if->setStatus(Ezer_IntStep::STEP_STATUS_ACTIVE);
$if->setCondition('$condition == 3 && $expression');
$if->setContainer($sequence, 1);
$if->save();


$activity = new Ezer_PropelActivityStep();
$activity->setName('If Message');
$activity->setStatus(Ezer_IntStep::STEP_STATUS_ACTIVE);
$activity->setClass('SayActivity');
$activity->setArgs(array('ifMessage'));
$activity->setContainer($if);
$activity->save();


$else = new Ezer_PropelElse();
$else->setStatus(Ezer_IntStep::STEP_STATUS_ACTIVE);
$else->setContainer($if);
$else->save();


$activity = new Ezer_PropelActivityStep();
$activity->setName('Else Message');
$activity->setStatus(Ezer_IntStep::STEP_STATUS_ACTIVE);
$activity->setClass('SayActivity');
$activity->setArgs(array('elseMessage'));
$activity->setContainer($else);
$activity->save();


$activity = new Ezer_PropelActivityStep();
$activity->setName('End Message');
$activity->setStatus(Ezer_IntStep::STEP_STATUS_ACTIVE);
$activity->setClass('SayActivity');
$activity->setArgs(array('endMessage'));
$activity->setContainer($sequence, 2);
$activity->save();


