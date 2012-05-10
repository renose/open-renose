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
    public $scaffold;

    public function beforeFilter()
    {
        parent::beforeFilter();
        $this->Auth->allow(array('login', 'register', 'activate'));
    }

    function login()
    {
        if($this->request->data)
        {
            if ($this->Auth->login())
            {
                $this->Session->setFlash('Sie haben sich erfolgreich eingeloggt.', 'flash_success');
                $this->redirect($this->Auth->redirect());
            }
            else
                $this->Auth->flash('Email Adresse oder Passwort falsch! Bitte versuche es erneut.');
        }

        //Bereits eingeloggt?
        if ($this->Auth->loggedIn())
        {
            $this->Session->setFlash('Sie sind bereits eingeloggt. Bitte loggen Sie sich zuerst aus.', 'flash_notice');
            $this->redirect($this->Auth->redirect());
        }
    }

    function logout()
    {
        if ($this->Auth->loggedIn())
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
        //pr($this->User);
        //pr($this->Auth);

        if ($this->request->data)
        {
            //Setze Activation Key
            $activationkey = $this->request->data['User']['email'] . time() . $this->request->data['User']['password'];
            $this->request->data['User']['activationkey'] = $this->Auth->password($activationkey);

            if ($this->User->save($this->request->data))
            {
                App::uses('CakeEmail', 'Network/Email');

                $user = $this->request->data;

                $email = new CakeEmail('default');

                $email  ->to( $user['User']['email'])
                        ->subject('Ihre Registrierung bei open reNose')
                        ->template('register')
                        ->sendAs('both')
                        ->viewVars(array(
                            'user' => $user
                            )
                        );

                $email->send('My message');

                $this->Session->setFlash('Registrierung erfolgreich. Bitte prüfen Sie ihr Email-Postfach für die Aktivierung ihres Accounts.', 'flash_success');
                $this->redirect(array('controller' => 'users', 'action' => 'login'));
            }
            else
            {
                $this->request->data['User']['password'] = null;
                $this->request->data['User']['password_confirm'] = null;
            }
        }
    }

    function activate($email, $activationkey)
    {
        if ($email == null || $activationkey == null)
        {
            $this->Session->setFlash('Fehlerhafter Link.', 'flash_notice');
            $this->redirect('/');
        }

        $user = $this->User->findByEmail($email);

        if ($user)
        {
            if ($user['User']['activationkey'] == $activationkey)
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
        if ($Profile['Profile']['first_name'])
        {
            //Setze Vornamen
            $name = $Profile['Profile']['first_name'];

            //Nachname auch bekannt? - setzen
            if ($Profile['Profile']['last_name'])
                $name .= ' ' . $Profile['Profile']['last_name'];
        }
        //Vorname nicht bekannt aber Nachname?
        else if ($Profile['Profile']['last_name'])
        {
            //Setze Nachname mit Herr/Frau
            $name .= 'Herr/Frau' . $Profile['Profile']['last_name'];
        }
        //Beides Unbekannt
        else
        {
            //Registriter User
            if ($this->Auth->user())
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

        //pr($this->User->findById($this->Auth->user('id')));

        $user = $this->User->findById($this->Auth->user('id'));
        pr($user);

        //pr($profile);
        //pr($this->User->find('all'));
        //pr($this->User->Profile->find('all'));
        //pr($this->Auth);

        $this->set('User', $user);
        $this->set('Profile', $profile);

        //echo $this->Auth->password('unknown');
        /* echo $this->Auth->password('simon');
          echo '<br/>';
          echo $this->Auth->password('patrick'); */

        //pr($this->Auth);
    }
}
?>