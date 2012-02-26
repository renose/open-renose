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

	public function show()
	{

	    //get all pages from DB
	    database::init();
	    $res = mysql_query(database::escapeSQL("SELECT * FROM ". database::praefix . "pages;"));
		while($row = mysql_fetch_array($res))
		{
			$pageList[] = array('id' => $row[0], 'title' => $row[1], 'value' => $row[2]);
		}

	    // register to tpl engine
	    $this->tpl->pageList = $pageList;
	    $this->tpl->display(database::getModuleTpl('page', 'page.tpl')); // load tpl file
	}
}

?>