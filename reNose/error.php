<?php
        require_once("path.php");
        setPath("./");

        require_once(BASE_PATH . "/system/core/cms/rendertime.php");
        $start = renderTime();

	require_once(BASE_PATH . "/system/core/error/error.php");

	$website = new errorPage();
	$website->show();

	echo "|Error Page|";

        // Zeitstop
        $stop = renderTime();
        $run = $stop - $start;
        echo "<p style='margin:0;padding:0;font-size:9px;float:right;'>" . substr($run, 0, 5) . " sek</p>";
?>