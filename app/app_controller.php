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

class AppController extends Controller
{
        var $components = array('Auth', 'Session');

        function beforeFilter()
        {
            //$this->Auth->userScope = array('User.is_active' => true);
            $this->Auth->loginRedirect = array(Configure::read('Routing.admin') => false, 'controller' => 'users', 'action' => 'welcome');
            $this->Auth->logoutRedirect = array(Configure::read('Routing.admin') => false, 'controller' => 'pages', '/view/home');
            $this->Auth->authorize = 'controller';
            //$this->Auth->autoRedirect = false;
            
            $this->Auth->fields = array(
                'username' => 'email',
                'password' => 'password'
                );

            $this->Auth->loginError = "Email Adresse oder Passwort falsch! Bitte versuche es erneut.";
            $this->Auth->authError = "Sie haben keine Berechtigung für diese Seite.";

            //Allowed Actions setzen
            $this->setAllow();
            //$this->Auth->allow('*');
        }

        function setAllow()
        {
            $this->loadModel('Group');
            
            //Nicht eingeloggt - Gästerechte prüfen
            $group = $this->Group->findByName('anonymous');
            //debug($group);

            foreach($group['GroupPermission'] as $permission)
            {
                if(strcasecmp($permission['controller'], $this->name) == 0 &&
                        strcasecmp($permission['action'], $this->action) == 0)
                {
                    if($permission['type'] == 1)
                        $this->Auth->allow($permission['action']);
                    else
                        $this->Auth->deny($permission['action']);
                }
            }
        }
        function isAuthorized()
        {
            $allow = false;
            $this->loadModel('User');
            $this->loadModel('Group');
            
            $user = $this->User->findById($this->Auth->user('id'));
            /*debug($user);
            debug($this->name);
            debug($this->action);*/

            if($user)
            {
                //Alle Speziell zu geteilten Gruppen prüfen
                foreach($user['Group'] as $group)
                {
                    $group = $this->Group->findById($group['id']);
                    //debug($group);

                    foreach($group['GroupPermission'] as $permission)
                    {
                        if(strcasecmp($permission['controller'], $this->name) == 0 &&
                                strcasecmp($permission['action'], $this->action) == 0)
                        {
                            if($permission['type'] == 1)
                                $allow = true;
                            else
                                return false;
                        }
                    }
                }

                //Aktivierter User Account - User Gruppen Berechtigungen
                if($user['User']['is_active'])
                {
                    $group = $this->Group->findByName('users');
                    //debug($group);

                    foreach($group['GroupPermission'] as $permission)
                    {
                        if(strcasecmp($permission['controller'], $this->name) == 0 &&
                                strcasecmp($permission['action'], $this->action) == 0)
                        {
                            if($permission['type'] == 1)
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
