<?php
login::checkAdmin();
class editPage extends plugin {

    public $name = "editPage";
    public $description = "Editiert CMS Textseiten mithilfe des CKEditors";
    public $version = "alpha";

    public function getTitle() {
	return "Seite bearbeiten";
    }

    public static function getSitebyID($id, $type) {
	if ($id == "") {
	    echo "Sorry, diese Seite gibt es noch nicht.";
	    exit;
	}

	if ($id == "new") {
	    
	} else {
	    $database = database::get();
	    $sql = "SELECT title, description, value
			FROM " . database::praefix . "pages
		WHERE id =:id";
	    $stmn = $database->prepare($sql);
	    $stmn->bindValue(':id', $id, PDO::PARAM_STR);
	    $stmn->execute();

	    $row = $stmn->fetch();
	    $stmn->closeCursor();

	    return $row[$type];
	}
    }

    public static function updateSiteToDB($id, $title, $description, $value) {
	$database = database::get();
	$sql = "UPDATE " . database::praefix . "pages
		SET title =:title,
		    description =:description,
		    value =:value
		WHERE id =:id
		    ";
	$stmn = $database->prepare($sql);
	$stmn->bindValue(':id', $id, PDO::PARAM_STR);
	$stmn->bindValue(':title', $title, PDO::PARAM_STR);
	$stmn->bindValue(':description', $description, PDO::PARAM_STR);
	$stmn->bindValue(':value', $value, PDO::PARAM_STR);
	$stmn->execute();

	$stmn->closeCursor();
	
	return true;
    }

    public static function createSiteToDB($headline, $description, $value) {
	database::init();
	$res = mysql_query("INSERT INTO " . database::praefix . "pages (id ,title ,description ,value) VALUES (NULL , '" . $headline . "', '" . $description . "', '" . $value . "');");

	return true;
    }

    public function show() {
	$this->tpl->display(database::getModuleTpl('editPage', 'editPage.tpl')); // load tpl file
    }

}

if ($_POST['updatePage'] && $_GET['new']) {
    $query = editPage::createSiteToDB($_POST['headline'], $_POST['description'], htmlspecialchars($_POST['pageEdit']));
} else if ($_POST['updatePage']) {
   editPage::updateSiteToDB($_GET['id'], $_POST['headline'], $_POST['description'], htmlspecialchars($_POST['pageEdit']));
}
?>