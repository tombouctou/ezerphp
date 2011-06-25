<?php
require_once dirname(__FILE__) . '/../../bootstrap.php';

$config = Ezer_Config::createFromPath(dirname(__FILE__) . '/../../config/ajax.xml');

Propel::setConfiguration($config->database->toArray());
Propel::initialize();

$uri = $_SERVER['REQUEST_URI'];
EzerAjaxFrontController::run($uri);

