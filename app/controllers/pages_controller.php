<?php

class PagesController extends AppController
{
	var $name = 'Pages';
	
	function index()
	{
		$this->redirect(array('controller' => 'pages', 'action' => 'view', 'home'));
		//$this->flash('Auf Home-Seite weiterleiten...', array('controller' => 'pages', 'action' => 'view', 1));
	}

	function display()
	{
		$this->set('pages', $this->Page->find('all'));
	}
	
	function view($title = null)
	{
		$this->Page->title = $title;
		$this->set('page', $this->Page->read());
	}
}

?>