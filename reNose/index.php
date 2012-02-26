<?php
        require_once("path.php");
        setPath(0);

	require_once(BASE_PATH . "/system/core/cms/renose.php");
	
	$website = new renose();
	$website->show();
	
?>