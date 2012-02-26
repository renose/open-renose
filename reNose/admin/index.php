<?php
login::checkAdmin();
class admin extends plugin {

    public $name = "admin";
    public $description = "";
    public $version = "alpha";

    public function getTitle() {
	return "Adminpanel";
    }

    public function show() {
	/* PAGE module */
	$database = database::get();
	$sql = "SELECT *
                FROM " . dbconfig::praefix . "pages
	";
	foreach ($database->query($sql) as $row) {
	    $pageList[] = array('id' => $row['id'], 'title' => $row['title'], 'description' => $row['description'], 'value' => $row['value']);
	}

	/* SETTINGS module */
	$database = database::get();
	$sql = "SELECT *
                FROM " . dbconfig::praefix . "settings
	";
	foreach ($database->query($sql) as $row) {
	    $settingList[] = array('property' => $row['property'], 'value' => $row['value']);
	}

	/* USER Module */
	$database = database::get();
	$sql = "SELECT *
                FROM " . dbconfig::praefix . "users
	";
	foreach ($database->query($sql) as $row) {
	    $userList[] = array('id' => $row['id'], 'username' => $row['username'], 'isAdmin' => $row['isAdmin'], 'prename' => $row['prename'], 'name' => $row['name']);
	}

	// register to tpl engine
	$this->tpl->userList = $userList;
	$this->tpl->settingList = $settingList;
	$this->tpl->pageList = $pageList;


	$this->tpl->display(database::getModuleTpl('adminpanel', 'admin.tpl')); // load tpl file
    }

}

?>