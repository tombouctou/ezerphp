<?php

// Autoloader
require_once(dirname(__FILE__) . '/infra/Ezer_Autoloader.php');
Ezer_Autoloader::setClassMapFilePath(Ezer_Autoloader::buildPath(realpath(dirname(__FILE__) . '/../'), 'cache', 'EzerClassMap.cache'));
//Ezer_Autoloader::dumpExtra();
Ezer_Autoloader::register();


