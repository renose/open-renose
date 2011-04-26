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
        var $components = array('Email');
        //var $helpers = array('Html', 'Ajax', 'Javascript');

        function beforeFilter()
        {
            parent::beforeFilter();

            $this->Auth->allow('login', 'logout', 'activate', 'get_name');
        }

        function login()
        {
            /*if($this->data)
            {
                //$this->Session->write("User", $this->Auth->user());
                //$this->Session->write("User.Name", $this->get_name());

                $this->redirect($this->Auth->redirect());
            }*/

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
                //$this->Session->delete('User');
                $this->Session->setFlash('Sie wurden erfolgreich ausgeloggt.', 'flash_success');
                $this->redirect($this->Auth->logout());
            }
            else
            {
                $this->Session->setFlash('Sie sind nicht eingeloggt, Sie können sich nicht ausloggen.', 'flash_notice');
                $this->redirect('/');
            }
        }
        
        function register()
        {
            //debug($this->User);
            //debug($this->Auth);
            
            if ($this->data)
            {
                //Setze Activation Key
                $activationkey = $this->data['User']['email'] . time() . $this->data['User']['password'];
                $this->data['User']['activationkey'] = $this->Auth->password($activationkey);

                if ($this->User->save($this->data))
                {
                    $User = $this->data;
                    //$this->Email->delivery = 'mail';
                    $this->Email->delivery = 'debug';
                    $this->Email->to = $User['User']['email'];
                    $this->Email->subject = 'Ihre Registrierung bei open reNose';
                    $this->Email->replyTo = 'noreply@renose.de';
                    $this->Email->from = 'open reNose <info@renose.de>';
                    $this->Email->template = 'register';
                    //Send as 'html', 'text' or 'both' (default is 'text')
                    $this->Email->sendAs = 'both'; // because we like to send pretty mail
                    //Set view variables as normal
                    $this->set('User', $User);
                    //Do not pass any args to send()
                    $this->Email->send();

                    $this->Session->setFlash('Registrierung erfolgreich. Bitte prüfen Sie ihr Email-Postfach für die Aktivierung ihres Accounts.', 'flash_success');
                    $this->redirect(array('controller' => 'users', 'action' => 'login'));
                } else {
                    $this->data['User']['password'] = null;
                    $this->data['User']['password_confirm'] = null;
                }
            }
        }
        function activate($email, $activationkey)
        {
            if($email == null || $activationkey == null)
            {
                $this->Session->setFlash('Fehlerhafter Link.', 'flash_notice');
                $this->redirect('/');
            }

            $user = $this->User->findByEmail($email);

            if($user)
            {
                if($user['User']['activationkey'] == $activationkey)
                {
                    $user['User']['is_active'] = 1;
                    $user['User']['activationkey'] = NULL;
                    $this->User->save($user);

                    $this->Session->setFlash('Account erfolgreich aktiviert.', 'flash_success');
                    $this->redirect(array('controller' => 'users', 'action' => 'login'));
                }
                else
                {
                    $this->Session->setFlash('Fehlerhafter Aktivierungscode. Bitte Konatieren Sie einen Administrator.', 'flash_fail');
                    $this->redirect('/');
                }
            }
            else
            {
                $this->Session->setFlash('User nicht gefunden. Bitte Konatieren Sie einen Administrator.', 'flash_fail');
                $this->redirect('/');
            }
        }

        function welcome()
        {
            $user = $this->User->findById($this->Auth->user('id'));
            $profile = $this->User->Profile->findByUserId($user['User']['id']);

            $this->set('User', $user);
            $this->set('Profile', $profile);
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

            return $name;
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