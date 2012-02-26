<?php
/*
 * pages_controller.php
 *
 * Copyright (c) 2011 open reNose team <info at renose.de>.
 * Simon Wörner and Patrick Hafner.
 *
 * This file is part of open reNose.
 *
 * open reNose is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * open reNose is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with open reNose.  If not, see <http ://www.gnu.org/licenses/>.
 */
?>

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
            $this->set('title_for_layout', 'Seiten Verwalten');
            $this->set('pages', $this->Page->find('all'));
	}
	
	function view($title = null)
	{
		if($title == null)
                    $this->redirect('/');
		
		$page = $this->Page->findByTitle($title);

                //Page not found?
		if($page == null)
		{
                    //Try searching by id
                    $this->Page->id = $title;
                    $page = $this->Page->read();

                    //Still not found? => Error
                    if($page == null)
                        $this->cakeError('error404');
		}

                //Set page title and content for layout
                $this->set('title_for_layout', $page['Page']['description']);
                $this->set('page', $page);
	}
	
	function add()
	{
            $this->set('title_for_layout', 'Seite erstellen');

            if (!empty($this->data))
            {
                if ($this->Page->save($this->data))
                {
                    $this->Session->setFlash('Ihre Seite wurde erstellt.');
                    $this->redirect( array('action' => 'view', $this->data['Page']['title']) );
                }
            }
	}
	
	function edit($id = null)
	{
            $this->set('title_for_layout', 'Seite bearbeiten');
            
            $this->Page->id = $id;

            if (empty($this->data))
            {
                $this->data = $this->Page->read();
            }
            else if ($this->Page->save($this->data))
            {
                $this->Session->setFlash('Ihre Änderungen wurden übernommen.');
                $this->redirect( array('action' => 'view', $this->data['Page']['title']) );
            }
	}
	
	
	function delete($id)
	{
            $this->set('title_for_layout', 'Seite löschen');
            
            $this->Page->delete($title);
            $this->Session->setFlash('Die Seite "'.$title.'" wurde gelöscht.');
            $this->redirect( array('action' => 'display') );
	}
	
}

?>