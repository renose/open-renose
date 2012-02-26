<?php

class page extends plugin {

    public $name = "page";
    public $description = "Erstellen und Editieren der Contentseiten mithilfe des CKEditors";
    public $version = "alpha";

    public function getTitle() {
	return "Seitenmodul";
    }

    public function show() {

	$database = database::get();
	$sql = "SELECT *
                FROM " . dbconfig::praefix . "pages
	";

	foreach ($database->query($sql) as $row) {
	    $pageList[] = array('id' => $row['id'], 'title' => $row['title'], 'description' => $row['description'], 'value' => $row['value']);
	}

	// register to tpl engine
	$this->tpl->pageList = $pageList;
	$this->tpl->display(database::getModuleTpl('page', 'page.tpl')); // load tpl file
    }

}

?>