<?php

// Autoloader
require_once(dirname(__FILE__) . '/../engine/infra/Ezer_Autoloader.php');
Ezer_Autoloader::addClassPath(Ezer_Autoloader::buildPath(dirname(__FILE__), 'lib', '*'));
Ezer_Autoloader::addClassPath(Ezer_Autoloader::buildPath(dirname(__FILE__), 'controllers', '*'));
Ezer_Autoloader::setClassMapFilePath(Ezer_Autoloader::buildPath(realpath(dirname(__FILE__)), 'cache', 'EzerClassMap.cache'));
//Ezer_Autoloader::dumpExtra();
Ezer_Autoloader::register();


