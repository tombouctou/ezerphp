<?php

$path = 'cases';
$dir = dir($path);

$files = array();
while (false !== ($entry = $dir->read())) 
{
	if($entry == '.' || $entry == '..' || $entry == '.svn')
		continue;

	if(preg_match('/.+\.arc/', $entry))
		$files[] = "$path/$entry";
}
$dir->close();

foreach($files as $file)
{
	$archive = str_replace('.arc', '.pbc', $file);
	rename($file, $archive);
}

