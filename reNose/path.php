<?php 

function setPath($relativePathToRoot)
{
	define('BASE_PATH', realpath($relativePathToRoot));
	
	$url = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') ? 'https://' : 'http://') . $_SERVER['HTTP_HOST'];
	define('BASE_URL', $url . dirname($_SERVER["SCRIPT_NAME"])); //$relativePathToRoot
}

?>