<?php
        require_once("path.php");
        setPath("./");

        require_once(BASE_PATH . "/system/core/cms/rendertime.php");
        $start = renderTime();

	require_once(BASE_PATH . "/system/core/register/register.php");

	$website = new register();
	$website->show();

	if ($_POST['newRegistration']) {

	    $website->registerNewUser($rNUusername, $rNUmail, $rNUpassword);
	}

	echo "|Register Page|";

        // Zeitstop
        $stop = renderTime();
        $run = $stop - $start;
        echo "<p style='margin:0;padding:0;font-size:9px;float:right;'>" . substr($run, 0, 5) . " sek</p>";
?>