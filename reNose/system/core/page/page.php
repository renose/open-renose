<?php
require_once(BASE_PATH . "/system/core/cms/plugin.php");
require_once(database::getModulePath('cms', 'root') . "/autoloader.php");

class page extends plugin
{
	public $name = "page";
	public $description = "Erstellen und Editieren der Contentseiten mithilfe des CKEditors";
	public $version = "0.1";

	public function getTitle()
	{
		return "Seitenmodul";
	}

	public static function getAllSitesFromDB() {
	    database::init();
	    $res = mysql_query(database::escapeSQL("SELECT * FROM ". database::praefix . "pages;"));
	    while ($row = mysql_fetch_assoc($res)) {
		return $foo = $row['title'];
		$bar = $row['value'];
	    }


	}


	public function show()
	{
	    $test = array(
		array(
		    "foo" => "bar",
		    "baaz" => "joo"
		),
		array(
		    "foo" => "footest",
		    "baaz" => "test"
		)
	    );
	    $this->tpl->array = $test;
		$this->tpl->display(database::getModuleTpl('page', 'page.tpl')); // load tpl file
	}
}

?>