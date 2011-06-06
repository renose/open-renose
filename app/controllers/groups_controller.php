<?php

/*
 * groups_controller.php
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
class GroupsController extends AppController
{
    var $name = 'Groups';
    var $components = array('ControllerList', 'RequestHandler');
    var $helpers = array('Html', 'Ajax', 'Javascript');

    function index()
    {
         $this->redirect( array('action' => 'display') );
    }

    function display()
    {
        $this->set('title_for_layout', 'Gruppen Verwalten');
        
        $this->set('groups', $this->Group->find('all'));
    }

    function add()
    {
        $this->set('title_for_layout', 'Gruppe erstellen');

        if (!empty($this->data))
        {
            if ($this->Group->save($this->data))
            {
                $this->Session->setFlash('Ihre Gruppe wurde erstellt.', 'flash_success');
                $this->redirect( array('action' => 'display') );
            }
        }
    }

    function edit($name)
    {
        $this->set('title_for_layout', 'Gruppe bearbeiten');
        /*if($this->params['isAjax'])
            $this->layout = NULL;*/

        if (empty($this->data))
        {
            $group = $this->Group->findByName($name);
            if($group == null)
                $this->cakeError('error404');

            $this->Group->id = $group['Group']['id'];
            $this->data = $this->Group->read();
        }
        else if ($this->Group->save($this->data))
        {
            $this->Session->setFlash('Ihre Änderungen wurden übernommen.', 'flash_success');
            $this->redirect( array('action' => 'display') );
        }
    }

    function delete($name)
    {
        $this->set('title_for_layout', 'Gruppe löschen');

        $group = $this->Group->findByName($name);
        if($group == null)
            $this->cakeError('error404');

        $this->Group->delete($group['Group']['id']);
        $this->Session->setFlash('Die Gruppe "' . $group['Group']['description'] . '" (' . $group['Group']['name'] . ') wurde gelöscht.', 'flash_success');
        $this->redirect( array('action' => 'display') );
    }

    function permissions($name, $do = null, $controller = null, $action = null)
    {
        if(!$this->params['isAjax'] || $do == null)
        {
            $group = $this->Group->findByName($name);
            if($group == null)
                $this->cakeError('error404');

            $this->set('controllers', $this->ControllerList->get($group['GroupPermission']));
            $this->set('group', $group);
            return;
        }

        if($do != 'allow' &&
            $do != 'deny' &&
            $do != 'delete')
            $this->cakeError('error404');

        $this->layout = NULL;

        $group = $this->Group->findByName($name);
        if($group == null)
            $this->cakeError('error404');

        if($do == 'delete')
        {
            $this->loadModel('GroupPermission');
            $this->GroupPermission->deleteAll(array(
                    'GroupPermission.group_id' => $group['Group']['id'],
                    'GroupPermission.controller' => $controller,
                    'GroupPermission.action' => $action));
        }
        else
        {
            $this->Group->id = $group['Group']['id'];
            $this->data = $this->Group->read();

            $done = false;
            foreach($this->data['GroupPermission'] as $id => $groupPermission)
            {
                if(strcasecmp($groupPermission['controller'], $controller) == 0 &&
                    strcasecmp($groupPermission['action'], $action) == 0)
                {
                    if($do == 'allow')
                    {
                        $this->data['GroupPermission'][$id]['type'] = 1;
                        $done = true;
                        break;
                    }

                    else if($do == 'deny')
                    {
                        $this->data['GroupPermission'][$id]['type'] = 0;
                        $done = true;
                        break;
                    }
                }
            }

            if(!$done)
            {
                if($do == 'allow')
                    $this->data['GroupPermission'][] = array('group_id' => $group['Group']['id'], 'controller' => $controller, 'action' => $action, 'type' => 1);

                 else if($do == 'deny')
                    $this->data['GroupPermission'][] = array('group_id' => $group['Group']['id'], 'controller' => $controller, 'action' => $action, 'type' => 0);
            }

            $this->Group->saveAll($this->data);
        }

        $group = $this->Group->findByName($name);
        $this->set('controllers', $this->ControllerList->get($group['GroupPermission']));
        $this->set('group', $group);
    }

    function users($name)
    {
        $this->set('title_for_layout', 'Gruppebenutzer bearbeiten');
        /*if($this->params['isAjax'])
            $this->layout = NULL;*/
        
        $group = $this->Group->findByName($name);
        if($group == null)
            $this->cakeError('error404');

        $this->set('users', $group['User']);

    }
}
?>