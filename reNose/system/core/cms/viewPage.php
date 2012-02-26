<?php

class viewPage extends plugin {

    public $name = "viewPage";
    public $description = "Zeigt CMS Textseiten aus der DB an";
    public $version = "alpha";

    public static function getSitebyID($id, $value) {
	if ($id) {
	    $database = database::get();
	    $sql = "SELECT title, description, value
		    FROM " . database::praefix . "pages
		    WHERE url like :id";
	    $stmn = $database->prepare($sql);
	    $stmn->bindValue(':id', $id, PDO::PARAM_STR);
	    $stmn->execute();

	    $row = $stmn->fetch();
	    $stmn->closeCursor();

	    if(!$row) {
		exit;
	    }

	    return $row[$value];
	}
    }

    public function getTitle() {
	return $this->getSitebyID($_GET['name'], "title");
    }

    public function show() {
	$this->tpl->getTitle = $this->getSitebyID($_GET['name'], "title");
	#$this->tpl->getText = htmlspecialchars_decode($this->getSitebyID($_GET['id'], "value"));
	$this->tpl->display(database::getModuleTpl('viewPage', 'viewpage.tpl')); // load tpl file
	}

}

?>