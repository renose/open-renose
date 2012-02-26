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

	// ########SETTINGS########################
	$dbName = "renose";      // Name der DB   #
	$sqlFile = "renose.sql"; // .sql Filename #
	// ########################################

	if ($_POST) {
	    try {
		$database = database::get();
		$sql = "DROP DATABASE $dbName";

		$database->exec($sql);

		echo "<p style='color:lime;margin:0;padding:0;'>Datenbank wurde gel&ouml;scht.</p>";
	    } catch (PDOException $e) {
		echo "<p style='color:red;margin:0;padding:0;'>Datenbank konnte nicht gel&ouml;scht werden.</p>";
		echo $e->getMessage();
	    }

	    try {
		$database = new PDO('mysql:host=' . dbconfig::host,
				dbconfig::user,
				dbconfig::password,
				array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
		$database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		$sql = "CREATE DATABASE $dbName";
		$database->exec($sql);

		echo "<p style='color:lime;margin:0;padding:0;'>Datenbank wurde neu erstellt.</p>";

		try {
		    database::close();
		    $database = database::get();

		    $sqlText = file_get_contents($sqlFile);
		    $sqlText = preg_replace("%/\*(.*)\*/%Us", '', $sqlText);
		    $sqlText = preg_replace("%^--(.*)\n%mU", '', $sqlText);
		    $sqlText = preg_replace("%^$\n%mU", '', $sqlText);
		    mysql_real_escape_string($sqlText);
		    $sqlText = explode(";", $sqlText);

		    foreach ($sqlText as $imp) {
			if (!empty($imp) && trim($imp) !== '') {
			    $database->exec($imp);
			}
		    }

		    echo "<p style='color:lime;margin:0;padding:0;'>Tabellen eingetragen</p>";
		} catch (PDOException $e) {
		    echo "<p style='color:red;margin:0;padding:0;'>Tabellen eintragen fehlgeschlagen</p>";
		    echo $e->getMessage();
		}
	    } catch (PDOException $e) {
		echo "<p style='color:red;margin:0;padding:0;'>Datenbank konnte nicht neu erstellt werden.</p>";
		echo $e->getMessage();
	    }
	}
	?>
	<hr />
	<p>now supports mysql pdo - thx to simon</p>

    </body>
</html>