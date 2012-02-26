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
	    $sql = "SELECT title, description, value, url
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

    public static function updateSiteToDB($id, $title, $description, $value, $url) {
	$database = database::get();
	$sql = "UPDATE " . database::praefix . "pages
		SET title =:title,
		    description =:description,
		    value =:value,
		    url =:url
		WHERE id =:id
		    ";
	$stmn = $database->prepare($sql);
	$stmn->bindValue(':id', $id, PDO::PARAM_STR);
	$stmn->bindValue(':title', $title, PDO::PARAM_STR);
	$stmn->bindValue(':description', $description, PDO::PARAM_STR);
	$stmn->bindValue(':value', $value, PDO::PARAM_STR);
	$stmn->bindValue(':url', $url, PDO::PARAM_STR);
	$stmn->execute();

	$stmn->closeCursor();
	
	return true;
    }

    public static function createSiteToDB($headline, $description, $value, $url) {
	$database = database::get();
	$sql = "INSERT INTO " . database::praefix . "pages
		(id, title, description, value, url)
		VALUES (NULL,:headline,:description,:value,:url)
		";

	$stmn = $database->prepare($sql);
	$stmn->bindValue(':headline', $headline, PDO::PARAM_STR);
	$stmn->bindValue(':description', $description, PDO::PARAM_STR);
	$stmn->bindValue(':value', $value, PDO::PARAM_STR);
	$stmn->bindValue(':url', $url, PDO::PARAM_STR);
	$stmn->execute();

	$stmn->closeCursor();

	return true;
    }

    public function show() {
	$this->tpl->display(database::getModuleTpl('editPage', 'editPage.tpl')); // load tpl file
    }

}

if ($_POST['updatePage'] && $_GET['id'] == "new") {
    editPage::createSiteToDB($_POST['headline'], $_POST['description'], htmlentities($_POST['pageEdit']), $_POST['url']);
} else if ($_POST['updatePage']) {
   editPage::updateSiteToDB($_GET['id'], $_POST['headline'], $_POST['description'], htmlentities($_POST['pageEdit']), $_POST['url']);
}
?>