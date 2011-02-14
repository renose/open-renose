<?php
session_start();

class logout extends plugin
{
	public $name = "logout";
	public $description = "Modul zum Ausloggen";
	public $version = "stable";

	public function getTitle()
	{
		return "Erfolgreich ausgeloggt";
	}

	//Logout Function
	public static function LogOutUser() {
	    ob_start ();
	    session_start ();
	    session_unset ();
	    session_destroy ();
	    ob_end_flush ();
	}

	public function show()
	{
	    // register to tpl engine
	    $this->tpl->display(database::getModuleTpl('logout', 'logout.tpl')); // load tpl file
	}
}

logout::LogOutUser();


?>