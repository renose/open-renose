<?php

/*
 * app_controller.php
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

App::import('Vendor', 'ChromePhp');

class AppController extends Controller
{

    public $layout = 'renose';
    public $components = array('Security', 'Session', 'Email',
        'Auth' => array(
            'loginAction' => array(
                'controller' => 'users',
                'action' => 'login',
            ),
            'loginRedirect' => '/',
            'logoutRedirect' => '/',
            'authError' => 'Sie haben keine Berechtigung für diese Seite.',
            'authenticate' => array(
                'Form' => array(
                    'userModel' => 'User', // needed for mac
                    'fields' => array('username' => 'email'),
                    'scope' => array('User.is_active' => true)
                )
            )
        ));

    public $helpers = array('Html', 'Js', 'Form', 'Session');

    function beforeFilter()
    {
        //Allowed Actions setzen
        $this->setAllowed();
    }

    function setAllowed()
    {
        $this->loadModel('Group');

        //Nicht eingeloggt - Gästerechte prüfen
        $group = $this->Group->findByName('anonymous');
        //pr($group);

        foreach ($group['GroupPermission'] as $permission)
        {
            if (strcasecmp($permission['controller'], $this->name) == 0 &&
                    strcasecmp($permission['action'], $this->request->action) == 0)
            {
                if ($permission['type'] == 1)
                    $this->Auth->allow($permission['action']);
                else
                    $this->Auth->deny($permission['action']);
            }
        }
    }

    function isAuthorized()
    {
        return $this->isAllowed($this->name, $this->request->action);
    }

    function isAllowed($controller, $action)
    {
        $allow = false;
        $this->loadModel('User');
        $this->loadModel('Group');

        $user = $this->User->findById($this->Auth->user('id'));

        if ($user)
        {
            //Alle Speziell zu geteilten Gruppen prüfen
            foreach ($user['Group'] as $group)
            {
                $group = $this->Group->findById($group['id']);

                foreach ($group['GroupPermission'] as $permission)
                {
                    if (strcasecmp($permission['controller'], $this->name) == 0 &&
                            strcasecmp($permission['action'], $this->request->action) == 0)
                    {
                        if ($permission['type'] == 1)
                            $allow = true;
                        else
                            return false;
                    }
                }
            }

            //Aktivierter User Account - User Gruppen Berechtigungen
            if ($user['User']['is_active'])
            {
                $group = $this->Group->findByName('users');

                foreach ($group['GroupPermission'] as $permission)
                {
                    if (strcasecmp($permission['controller'], $this->name) == 0 &&
                            strcasecmp($permission['action'], $this->request->action) == 0)
                    {
                        if ($permission['type'] == 1)
                            $allow = true;
                        else
                            return false;
                    }
                }
            }
        }

        return $allow;
    }

}
?>
