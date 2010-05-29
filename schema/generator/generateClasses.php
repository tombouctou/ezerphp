<?php

require_once 'Ezer_XsdClasses.php';

set_time_limit(0);

$generator = new Ezer_XsdClasses('Bpel_');
//$generator->loadFile('http://schemas.xmlsoap.org/ws/2003/03/business-process/');
$generator->loadFile('../xsd/bpel.xsd');
$generator->saveClasses('../types/bpel', 'bpel');


$generator = new Ezer_XsdClasses('WsBpel_');
//$generator->loadFile('http://schemas.xmlsoap.org/ws/2003/03/business-process/');
$generator->loadFile('../xsd/ws-bpel.xsd');
$generator->saveClasses('../types/wsbpel', 'wsbpel');

?>