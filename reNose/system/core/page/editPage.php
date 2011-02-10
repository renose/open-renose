<?php 
require_once(BASE_PATH . "/system/core/cms/plugin.php");
require_once(database::getModulePath('cms', 'root') . "/autoloader.php");

class editPage extends plugin
{
	public $name = "editPage";
	public $description = "Editiert CMS Textseiten mithilfe des CKEditors";
	public $version = "0.1";
	
	public function getTitle()
	{
		return "Seite bearbeiten";
	}

	public static function getSiteFromDB($id) {
	    database::init();
	    $res = mysql_query(database::escapeSQL("SELECT title, value FROM " . database::praefix . "pages WHERE id = '" . $id . "'"));
	    $row = mysql_fetch_row($res);

	    echo $row[0] . "<br /><br />";
	    echo $row[1];

	}

	public static function updateSiteFromDB ($id, $headline, $value) {
	    database::init();
	    $res = mysql_query(database::escapeSQL("UPDATE " . database::praefix . "pages  SET 'title' = '". $headline ."', 'value' = '". $value ."' WHERE id = '" . $id . "'"));
	    $row = mysql_fetch_row($res);
	}


	public function show()
	{
		$this->tpl->display(database::getModuleTpl('editPage', 'editPage.tpl')); // load tpl file
	}
}

?>