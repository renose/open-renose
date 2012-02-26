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

	public static function getSiteFromDB($id)
	{
		$database = database::get();
		$sql = "SELECT title, value
				FROM ".dbconfig::praefix."pages
				WHERE id=:id";
		
		$stmn = $database->prepare($sql);
		$stmn->bindValue(':module', $module, PDO::PARAM_STR);
		$stmn->execute();
		
		$row = $stmn->fetch();
		$stmn->closeCursor();

	    echo $row['title'] . "<br /><br />";
	    echo $row['value'];

	}

	public static function updateSiteFromDB ($id, $headline, $value)
	{
		$database = database::get();
		$sql = "UPDATE ".dbconfig::praefix."pages
				SET title=:title
				SET value=:value
				WHERE id=:id";
		
		$stmn = $database->prepare($sql);
		$stmn->bindValue(':title', $headline, PDO::PARAM_STR);
		$stmn->bindValue(':value', $value, PDO::PARAM_STR);
		$stmn->bindValue(':id', $id, PDO::PARAM_STR);
		
		$stmn->execute();
		$stmn->closeCursor();
	}


	public function show()
	{
		$this->tpl->display(database::getModuleTpl('editPage', 'editPage.tpl')); // load tpl file
	}
}

?>