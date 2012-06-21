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

App::uses('Security', 'Utility');

class UsersController extends AppController
{
    public function beforeFilter()
    {
        parent::beforeFilter();
        $this->Auth->allow(array('login', 'logout', 'register', 'activate', 'forgot', 'changepassword'));
    }

    function login()
    {
        //Bereits eingeloggt?
        if ($this->Auth->loggedIn())
        {
            $this->Session->setFlash('Sie sind bereits eingeloggt.', 'flash_notice');
            $this->redirect($this->Auth->redirect());
        }

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
    }

    function logout()
    {
        if ($this->Auth->loggedIn())
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

    function register()
    {
        if ($this->request->data)
        {
            //Setze Activation Key
            $this->request->data['User']['activationkey'] = Security::generateAuthKey();

            // manual hashing is required cause model validation function and save after positive result
            $this->request->data['User']['password'] = Security::hash($this->request->data['User']['password'], null, true);
            $this->request->data['User']['password_confirm'] = Security::hash($this->request->data['User']['password_confirm'], null, true);

            if ($this->User->save($this->request->data))
            {
                App::uses('CakeEmail', 'Network/Email');

                $user = $this->request->data;

                $email = new CakeEmail('default');

                $email  ->to($user['User']['email'])
                        ->subject('Ihre Registrierung bei open reNose')
                        ->template('register')
                        ->emailFormat('html')
                        ->viewVars(array(
                            'user' => $user
                            )
                        );

                try
                {
                    $email->send();
                }
                catch(Exception $e)
                {
                    //pr($e);

                    $this->Session->setFlash('Fehler beim Verschicken der Aktivierungs Mail.', 'flash_fail');
                    //$this->redirect(array('controller' => 'users', 'action' => 'register'));
                    $this->redirect(array('controller' => 'users', 'action' => 'activate', $user['User']['email'], $user['User']['activationkey']));
                }

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
                $user['User']['activationkey'] = null;
                $this->User->save($user);

                $this->Session->setFlash('Account erfolgreich aktiviert.', 'flash_success');
                $this->redirect(array('controller' => 'users', 'action' => 'login'));
            }
            else
            {
                $this->Session->setFlash('Fehlerhafter Aktivierungscode. Bitte kontaktieren Sie einen Administrator.', 'flash_fail');
                $this->redirect('/');
            }
        }
        else
        {
            $this->Session->setFlash('User nicht gefunden. Bitte kontaktieren Sie einen Administrator.', 'flash_fail');
            $this->redirect('/');
        }
    }

    function get_name()
    {
        $this->autoRender = false;
        $profile = $this->User->Profile->findByUserId($this->Auth->user('id'));
        
        if(isset($profile['Profile']['id']))
            return $profile['Profile']['first_name'] .' ' . $profile['Profile']['last_name'];
        else
            return 'Unbekannter';
    }


    public function forgot() {
        App::uses('CakeEmail', 'Network/Email');

        if($this->request->is('post') && $this->request->data['User']['email'] != false) {

            $data = $this->User->find('first', array(
                'conditions' => array(
                    'User.email' => $this->request->data['User']['email'],
                    'User.is_active' => 1
                )
            ));

            if(!$data) {
                $this->Session->setFlash('User nicht gefunden.', 'flash_fail');
                $this->redirect(array(
                    'controller' => 'users',
                    'action' => 'forgot'
                ));
            }

            $this->User->read(null, $data['User']['id']);

            $newAuthKey = Security::generateAuthKey();
            $this->User->set('activationkey', $newAuthKey);

            if($this->User->save()) {

                $email = new CakeEmail('default');

                $email->to($data['User']['email'])
                            ->subject('open reNose | Passwort ändern')
                            ->template('forgot')
                            ->emailFormat('html')
                            ->viewVars(array(
                                'data' => $data,
                                'newAuthKey' => $newAuthKey
                                )
                            );

                try {
                    $email->send();
                }
                catch(Exception $e) {
                    $this->Session->setFlash('Fehler beim Verschicken der Aktivierungs Mail.', 'flash_fail');
                }
                $this->Session->setFlash('E-Mail zur Passwortänderung wurde erfolgreich verschickt. Bitte prüfen Sie ihr E-Mail Postfach.', 'flash_success');
                $this->redirect('/');
            }

        }

        $this->set('title_for_layout', 'Passwort vergessen');
    }


    public function changepassword($email = null, $activationKey = null) {
        //$this->autoRender = false;
        $user = $this->User->find('first', array(
            'fields' => array(
                'User.email'
            ),
            'conditions' => array(
                'User.email' => $email,
                'User.activationkey' => $activationKey
            )
        ));

        if($user != false) {
            $this->set('email', $user['User']['email']);

            if ($this->request->is('post') || $this->request->is('put')) {

                if($this->User->save($this->request->data)) {
                    $this->request->data['User']['activationkey'] = '';
                    $this->request->data['User']['password'] = Security::hash($this->request->data['User']['password'], null, true);
                    $this->request->data['User']['password_confirm'] = Security::hash($this->request->data['User']['password_confirm'], null, true);
                    $this->User->save($this->request->data);

                    $email = new CakeEmail('default');

                    $email->to($user['User']['email'])
                                ->subject('open reNose | Passwort wurde geändert')
                                ->template('passwordchanged')
                                ->emailFormat('html');

                    try {
                        $email->send();
                    }
                    catch(Exception $e) {
                        $this->Session->setFlash('Fehler beim Verschicken der Mail.', 'flash_fail');
                    }

                    $this->Session->setFlash('Passwort wurde zurückgesetzt.', 'flash_success');
                    $this->redirect('/');
                }
                //$this->User->read(null, $data['User']['id']);
            } else {
                $this->request->data = $user;
            }
            //$this->render();
        } else {
            $this->Session->setFlash('E-Mail Adresse oder Aktivierungsschlüssel ungültig.', 'flash_fail');
            $this->redirect('/');
        }
        $this->set('title_for_layout', 'Passwort ändern');
    }
}
