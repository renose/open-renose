<?php

class AppController extends Controller
{
        var $components = array('Auth', 'Session');

        function beforeFilter()
        {
            //$this->Auth->userScope = array('User.active' => true);
            //$this->Auth->loginRedirect = array('controller' => 'page', 'action' => 'home');
            //$this->Auth->logoutRedirect = array(Configure::read('Routing.admin') => false, 'controller' => 'members', 'action' => 'logout');
            //$this->Auth->autoRedirect = false;

            $this->Auth->loginError = "Email Adresse oder Passwort falsch! Bitte versuche es erneut.";
            $this->Auth->authError = "Sie haben keine Berechtigung auf diese Seite.";

            $this->Auth->allow('*');
        }
}

?>
