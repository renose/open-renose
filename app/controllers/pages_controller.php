<?php

class PagesController extends AppController
{
	var $name = 'Pages';
	var $helpers = array('Javascript', 'Fck');
	
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
		//$this->Page->id = $title;
		//$this->set('page', $this->Page->read());
		
		//$this->Page->title = $title;
		//$this->set('page', $this->Page->findByTitle($title));
		
		if($title == null)
			$this->redirect('/');
		
		$page = $this->Page->findByTitle($title);
		
		//$this->Page->title = $title;
		//$page = $this->Page->read();
		
		if($page)
			$this->set('page', $page);
		else
		{
			$this->Page->id = $title;
			$page = $this->Page->read();
			
			if($page)
				$this->set('page', $page);
			else
				$this->cakeError('error404');
		}
	}
	
	function add()
	{
		if (!empty($this->data))
		{
			if ($this->Page->save($this->data))
			{
				$this->Session->setFlash('Your page has been saved.');
				$this->redirect(array('action' => 'view', $this->Page->id));
			}
		}
	}
	
	function edit($id = null)
	{
		$this->Page->id = $id;
		
		if (empty($this->data))
		{
			$this->data = $this->Page->read();
		}
		else
		{
			if ($this->Page->save($this->data))
			{
				$this->Session->setFlash('Your page has been updated.');
				$this->redirect( array('action' => 'view', $this->Page->t) );
			}
		}
	}
	
	
	function delete($id)
	{
		$this->Page->delete($title);
		$this->Session->setFlash('The page with title: '.$title.' has been deleted.');
		$this->redirect( array('action'=>'display') );
	}
	
}

?>