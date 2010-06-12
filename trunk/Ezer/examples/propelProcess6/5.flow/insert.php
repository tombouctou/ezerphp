<?php
error_reporting(E_ALL);

require_once 'bootstrap.php';

$config = Ezer_Config::createFromPath('config.xml');

Propel::setConfiguration($config->database->toArray());
Propel::initialize();

// insert process

$variable1 = new Ezer_Variable();
$variable1->setName('count');

$variable2 = new Ezer_Variable();
$variable2->setName('left1');

$variable3 = new Ezer_Variable();
$variable3->setName('left2');

$variable4 = new Ezer_Variable();
$variable4->setName('right1');

$variable5 = new Ezer_Variable();
$variable5->setName('right2');

$variable6 = new Ezer_Variable();
$variable6->setName('before');

$variable7 = new Ezer_Variable();
$variable7->setName('after');

$process = new Ezer_PropelBusinessProcess();
$process->setName('Flow');
$process->setStatus(Ezer_IntStep::STEP_STATUS_ACTIVE);
$process->addVariable($variable1);
$process->addVariable($variable2);
$process->addVariable($variable3);
$process->addVariable($variable4);
$process->addVariable($variable5);
$process->addVariable($variable6);
$process->addVariable($variable7);
$process->save();

$sequence = new Ezer_PropelSequence();
$sequence->setName('main');
$sequence->setStatus(Ezer_IntStep::STEP_STATUS_ACTIVE);
$sequence->setContainer($process);
$sequence->save();

$activity = new Ezer_PropelActivityStep();
$activity->setName('Before Flow');
$activity->setStatus(Ezer_IntStep::STEP_STATUS_ACTIVE);
$activity->setClass('FlowCountActivity');
$activity->setArgs(array('before', 'count'));
$activity->setContainer($sequence, 0);
$activity->save();

$flow = new Ezer_PropelFlow();
$flow->setName('Flow');
$flow->setStatus(Ezer_IntStep::STEP_STATUS_ACTIVE);
$flow->setContainer($sequence, 1);
$flow->save();

$sequenceLeft = new Ezer_PropelSequence();
$sequenceLeft->setName('Left Sequence');
$sequenceLeft->setStatus(Ezer_IntStep::STEP_STATUS_ACTIVE);
$sequenceLeft->setContainer($flow);
$sequenceLeft->save();

$activity = new Ezer_PropelActivityStep();
$activity->setName('First Left Count');
$activity->setStatus(Ezer_IntStep::STEP_STATUS_ACTIVE);
$activity->setClass('FlowCountActivity');
$activity->setArgs(array('left1', 'count'));
$activity->setContainer($sequenceLeft, 0);
$activity->save();

$activity = new Ezer_PropelActivityStep();
$activity->setName('Second Left Count');
$activity->setStatus(Ezer_IntStep::STEP_STATUS_ACTIVE);
$activity->setClass('FlowCountActivity');
$activity->setArgs(array('left2', 'count'));
$activity->setContainer($sequenceLeft, 1);
$activity->save();

$sequenceRight = new Ezer_PropelSequence();
$sequenceRight->setName('Right Sequence');
$sequenceRight->setStatus(Ezer_IntStep::STEP_STATUS_ACTIVE);
$sequenceRight->setContainer($flow);
$sequenceRight->save();

$activity = new Ezer_PropelActivityStep();
$activity->setName('First Right Count');
$activity->setStatus(Ezer_IntStep::STEP_STATUS_ACTIVE);
$activity->setClass('FlowCountActivity');
$activity->setArgs(array('right1', 'count'));
$activity->setContainer($sequenceRight, 0);
$activity->save();

$activity = new Ezer_PropelActivityStep();
$activity->setName('Second Right Count');
$activity->setStatus(Ezer_IntStep::STEP_STATUS_ACTIVE);
$activity->setClass('FlowCountActivity');
$activity->setArgs(array('right2', 'count'));
$activity->setContainer($sequenceRight, 1);
$activity->save();

$activity = new Ezer_PropelActivityStep();
$activity->setName('After Flow');
$activity->setStatus(Ezer_IntStep::STEP_STATUS_ACTIVE);
$activity->setClass('FlowCountActivity');
$activity->setArgs(array('after', 'count'));
$activity->setContainer($sequence, 2);
$activity->save();
