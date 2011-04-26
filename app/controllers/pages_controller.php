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
        var $components = array('RequestHandler');
	var $helpers = array('Html', 'Ajax', 'Javascript', 'Fck');

        function beforeFilter()
        {
            parent::beforeFilter();

            //$this->Html->addCrumb('Page', '/pages');
            //$this->Auth->allow('index', 'view');
        }
	
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
                    $this->Session->setFlash('Ihre Seite wurde erstellt.', 'flash_success');
                    $this->redirect( array('action' => 'view', $this->data['Page']['title']) );
                }
            }
	}
	
	function edit($title)
	{
            $this->set('title_for_layout', 'Seite bearbeiten');
            if($this->params['isAjax'])
                $this->layout = NULL;
            
            if (empty($this->data))
            {
                $page = $this->Page->findByTitle($title);
                if($page == null)
                    $this->cakeError('error404');
                
                $this->Page->id = $page['Page']['id'];
                $this->data = $this->Page->read();
            }
            else if ($this->Page->save($this->data))
            {
                $this->Session->setFlash('Ihre Änderungen wurden übernommen.', 'flash_success');
                $this->redirect( array('action' => 'view', $this->data['Page']['title']) );
            }
	}
	
	
	function delete($title)
	{
            $this->set('title_for_layout', 'Seite löschen');

            $page = $this->Page->findByTitle($title);
            if($page == null)
                    $this->cakeError('error404');

            $this->Page->delete($page['Page']['id']);
            $this->Session->setFlash('Die Seite "'.$page['Page']['description'].'" ('.$page['Page']['title'].') wurde gelöscht.', 'flash_success');
            $this->redirect( array('action' => 'display') );
	}
	
}

?>