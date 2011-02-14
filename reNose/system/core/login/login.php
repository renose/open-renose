<?php
session_start();

class login extends plugin
{
	public $name = "login";
	public $description = "Modul zum ein und ausloggen incl Sessions";
	public $version = "dev & not scrd";

	public function getTitle()
	{
		return "Login";
	}

	public static function checkUsernameandPassword($username, $password)
	{
	    $username = stripslashes($username);
	    $username = mysql_real_escape_string($username);

	    $password = stripslashes($password);
	    $password = mysql_real_escape_string($password);
	    $password = sha1($password);

	    try {
		$database = database::get();
		$sql = "SELECT id, username, isAdmin, prename, name
			FROM ". database::praefix . "users
                        WHERE username = :username
			AND password = :password
		";

		$stmn = $database->prepare($sql);
		$stmn->bindValue(':username', $username, PDO::PARAM_STR);
		$stmn->bindValue(':password', $password, PDO::PARAM_STR);

		$stmn->execute();
		$row = $stmn->fetch();

		$stmn->closeCursor();

		// Benutzerdaten in ein Array auslesen.
		// Sessionvariablen erstellen und registrieren
		$_SESSION["userid"] = $row["id"];
		$_SESSION["username"] = $row["username"];
		$_SESSION["prename"] = $row["prename"];
		$_SESSION["name"] = $row["name"];
		$_SESSION["admin"] = $row["isAdmin"];

		if ($row['id'] == "") {
		    echo "<script type='text/javascript'>alert('Username oder Passwort falsch');</script>";
		}
	}  catch (PDOException $e) {
		echo "<b>Fail</b><br>";
		echo $e->getMessage();
	    }

	}

	// Login Function
	public static function checkLogIn() {
	    if (!isset ($_SESSION["userid"])){
		header ("Location: login");
	    } else {
		return ($_SESSION["userid"] . $_SESSION["prename"] . $_SESSION["name"]);
	    }
	}

	public static function checkAdmin() {
	    if (!isset ($_SESSION["userid"])){
		header ("Location: login");
	    } else {
		if ($_SESSION["admin"] == 1) {
		    return true;
		} else {
		    exit;
		}
	    }
	}

	public function show()
	{
	    // register to tpl engine
	    $this->tpl->display(database::getModuleTpl('login', 'login.tpl')); // load tpl file
	}
}

if ($_POST['loginUser']) {
    login::checkUsernameandPassword($_POST['username'], $_POST['password']);
}

?>