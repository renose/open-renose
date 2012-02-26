<?php 

function setPath($subdirCount = 0)
{
	$path = './';
	for($i = 0; $i < $subdirCount; $i++)
	{
		$path .= '../';
	}
	
	define('BASE_PATH', realpath($path));
	
	$url = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') ? 'https://' : 'http://') . $_SERVER['HTTP_HOST'];	
	$base_url = $url . dirname($_SERVER["SCRIPT_NAME"]);
	for($i = 0; $i < $subdirCount; $i++)
	{
		$base_url = dirname($base_url);
	}
	
	define('BASE_URL', $base_url);
}

?>