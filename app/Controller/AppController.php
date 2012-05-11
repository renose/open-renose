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
            'authError' => 'Sie sind nicht eingeloggt, bitte einloggen.',
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
        // change layout to frontpage for guests
        if (!$this->Auth->user('id'))
            $this->layout = 'frontpage';
    }

    function beforeRender()
    {
        parent::beforeRender();

        // change layout on errors
        if ($this->name == 'CakeError') {
            if(!$this->Auth->user('id')) {
                $this->layout = 'frontpage';
            } else {
                $this->layout = 'renose';
            }
        }
    }

}