<?php

Router::connect('/', array('controller' => 'pages', 'action' => 'display', 'home'));
Router::connect('/page/*', array('controller' => 'pages', 'action' => 'display'));

CakePlugin::routes();

require CAKE . 'Config' . DS . 'routes.php';