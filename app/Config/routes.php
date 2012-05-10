<?php

Router::connect('/', array('controller' => 'pages', 'action' => 'display', 'home'));
Router::connect('/dashboard', array('controller' => 'users', 'action' => 'dashboard'));
Router::connect('/page/*', array('controller' => 'pages', 'action' => 'display'));

CakePlugin::routes();

require CAKE . 'Config' . DS . 'routes.php';
