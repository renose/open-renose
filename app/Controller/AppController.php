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
    public $helpers = array('Html', 'Js', 'Form', 'Session', 'Navigation');

    function beforeFilter()
    {
        // change layout to frontpage for guests
        if (!$this->Auth->loggedIn())
            $this->layout = 'frontpage';
        else
        {
        
            //redirect login users from page home to report overview
            if($this->request->params['controller'] == 'pages' && $this->request->params['action'] == 'display')
            {
                 //redirect login users from page home to edit profile (only if profile is not set)!!!
                 $this->loadModel('Profile');
                 $profile = $this->Profile->findByUserId($this->Auth->user('id'));

                if(!isset($this->request->params['pass'][0]))
                    $this->redirect ('/reports');
                
           //     else if($this->request->params['pass'][0] == 'home')
           //         $this->redirect ('/reports');

                else if 
                      (!isset($profile['Profile']['first_name']) 
                    || !isset($profile['Profile']['last_name'])
                    || !isset($profile['Profile']['job_name']) 
                    || !isset($profile['Profile']['street'])
                    || !isset($profile['Profile']['zip_code']) 
                    || !isset($profile['Profile']['city'])
                    || !isset($profile['Profile']['birthday']) 
                    || !isset($profile['Profile']['birthplace'])
                    || !isset($profile['Profile']['company']) 
                    || !isset($profile['Profile']['branch'])
                    || !isset($profile['Profile']['start_training_period']) 
                    || !isset($profile['Profile']['end_training_period'])
                    || !isset($profile['Profile']['contract_signed']) 
                    || !isset($profile['Profile']['contract_registered'])
                    || !isset($profile['Profile']['assigned_board_of_trade']))
                {
                    $this->redirect ('/profiles');
                }

            }
        }
    }
}