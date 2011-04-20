<?php
/*
 * users_controller.php
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
class UsersController extends AppController
{
	var $name = 'Users';

        function beforeFilter()
        {
            parent::beforeFilter();

            $this->Auth->allow('login', 'logout', 'get_name');
        }

        function login()
        {
            //Bereits eingeloggt?
            if($this->Auth->user())
            {
                $this->Session->setFlash('Sie sind bereits eingeloggt. Bitte loggen Sie sich zuerst aus.', 'flash_notice');
                $this->redirect($this->Auth->redirect());
            }
        }
        function logout()
        {
            if($this->Auth->user())
            {
                $this->Session->setFlash('Sie wurden erfolgreich ausgeloggt.', 'flash_success');
                $this->redirect($this->Auth->logout());
            }
            else
            {
                $this->Session->setFlash('Sie sind nicht eingeloggt, Sie können sich nicht ausloggen.', 'flash_notice');
                $this->redirect('/');
            }
        }
        
        function get($request)
        {
            if (!empty($this->params['requested']))
            {
                $user = $this->Auth->user();

                switch(strtolower($request))
                {
                    case 'user':
                        return $user;
                        break;

                    case 'profile':
                        $profile = $this->User->Profile->findByUserId($user['User']['id']);
                        return $profile;
                        break;

                    default:
                        return null;
                        break;
                }
            }
            else
            {
                $this->set(compact('User'));
            }
        }

        function get_name()
        {
            $Profile = $this->User->Profile->findByUserId($this->Auth->user('id'));

            //Vorname bekannt
            if($Profile['Profile']['first_name'])
            {
                //Setze Vornamen
                $name = $Profile['Profile']['first_name'];

                //Nachname auch bekannt? - setzen
                if($Profile['Profile']['last_name'])
                    $name .= ' ' . $Profile['Profile']['last_name'];
            }
            //Vorname nicht bekannt aber Nachname?
            else if($Profile['Profile']['last_name'])
            {
                //Setze Nachname mit Herr/Frau
                $name .= 'Herr/Frau' . $Profile['Profile']['last_name'];
            }
            //Beides Unbekannt
            else
            {
                //Registriter User
                if($this->Auth->user())
                    $name = 'Ninja';
                //Gast
                else
                    $name = 'Gast';
            }
            
            if (!empty($this->params['requested']))
            {
                return $name;
            }
            else
            {
                $this->set(compact('name'));
            }
        }

        function test()
        {
            $user = $this->Auth->user();
            $profile = $this->User->Profile->findByUserId($this->Auth->user('id'));

            //debug($this->User->findById($this->Auth->user('id')));

            $user = $this->User->findById($this->Auth->user('id'));
            debug($user);

            $this->loadModel('Group');
            foreach($user['Group'] as $group)
            {
                debug($this->Group->findById($group['id']));
            }

            //debug($profile);
            //debug($this->User->find('all'));
            //debug($this->User->Profile->find('all'));
            //debug($this->Auth);
            
            $this->set('User', $user);
            $this->set('Profile', $profile);

           //echo $this->Auth->password('unknown');
           /*echo $this->Auth->password('simon');
           echo '<br/>';
           echo $this->Auth->password('patrick');*/

            //debug($this->Auth);
        }
}
?>