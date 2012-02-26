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

	    database::init();
	    $res = mysql_query("SELECT id, username FROM ". database::praefix . "users WHERE username = '". $username ."' AND password = '". $password ."';");

	    if (mysql_num_rows ($res) > 0) {
		// Benutzerdaten in ein Array auslesen.
		$data = mysql_fetch_array ($res);
		var_dump($data);
		// Sessionvariablen erstellen und registrieren
		$_SESSION["userid"] = $data["id"];
		$_SESSION["username"] = $data["username"];
		echo ("ok");
	    }
	    else {
		echo "fehler";
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