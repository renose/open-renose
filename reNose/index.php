<?php
        require_once("path.php");
        setPath(0);

        require_once(BASE_PATH . "/system/core/cms/rendertime.php");
        $start = renderTime();

	require_once(BASE_PATH . "/system/core/cms/renose.php");
	
	$website = new renose();
	$website->show();
	
	echo "|User Page|";

        // Zeitstop
        $stop = renderTime();
        $run = $stop - $start;
        echo "<p style='margin:0;padding:0;font-size:9px;float:right;'>" . substr($run, 0, 5) . " sek</p>";
?>