<?php
	require_once('../path.php');
	setPath('./../');
	
	require_once(BASE_PATH . './system/core/cms/renose.php');
	
	$website = new renose();
	$website->show();
	
	echo "|Admin Page|";
?>