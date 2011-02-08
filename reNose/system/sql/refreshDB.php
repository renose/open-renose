<html>
    <head>
	<title>reNose DB refresher</title>
    </head>

    <body>
	<h1>reNose Datenbank aktualisieren</h1>
	<form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
	    <input type="submit" value="DB refreshen" name="del" style="width:160px; height:40px; font-size: 22px;" />
	</form>

	<?php
	require_once("../core/database/database.php");
	database::init();

	// ########SETTINGS########################
	$dbName = "renose";      // Name der DB   #
	$sqlFile = "renose.sql"; // .sql Filename #
	// ########################################

	if ($_POST['del']) {
	    $sql = mysql_query("DROP DATABASE $dbName");
	    if ($sql) {
		echo "<p style='color:lime;margin:0;padding:0;'>Datenbank wurde gel&ouml;scht.</p>";
	    } else {
		echo "<p style='color:red;margin:0;padding:0;'>Datenbank konnte nicht gel&ouml;scht werden.</p>";
	    }

	    $sqlText = file_get_contents($sqlFile);
	    $sqlText = preg_replace("%/\*(.*)\*/%Us", '', $sqlText);
	    $sqlText = preg_replace("%^--(.*)\n%mU", '', $sqlText);
	    $sqlText = preg_replace("%^$\n%mU", '', $sqlText);
	    mysql_real_escape_string($sqlText);
	    $sqlText = explode(";", $sqlText);

	    $sqlCreate = mysql_query("CREATE DATABASE `$dbName`;");

	    if ($sqlCreate) {
		echo "<p style='color:lime;margin:0;padding:0;'>Datenbank wurde neu erstellt.</p>";
		mysql_select_db("$dbName");

		foreach ($sqlText as $imp) {
		    if ($imp != '' && $imp != ' ') {
			mysql_query($imp);
		    }
		}
	    }

	    if ($imp) {
		echo "<p style='color:lime;margin:0;padding:0;'>Tabellen eingetragen</p>";
	    } else {
		"<p style='color:red;margin:0;padding:0;'>Tabellen eintragen fehlgeschlagen</p>";
	    }
	}
	?>
	<hr />
	<p>Built on 8th February 2010 12:15pm</p>

    </body>
</html>