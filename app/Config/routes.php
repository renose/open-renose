<?php

Router::connect('/', array('controller' => 'pages', 'action' => 'display', 'home'));
Router::connect('/page/*', array('controller' => 'pages', 'action' => 'display'));
Router::connect('/profile', array('controller' => 'profiles', 'action' => 'view'));
Router::connect('/schedule', array('controller' => 'schedules', 'action' => 'view'));

CakePlugin::routes();

require CAKE . 'Config' . DS . 'routes.php';