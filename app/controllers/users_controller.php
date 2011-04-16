<?php
class UsersController extends AppController
{
	var $name = 'Users';

        function beforeFilter()
        {
            parent::beforeFilter();

            $this->Auth->allow('*');
            $this->Auth->fields = array(
                'username' => 'email',
                'password' => 'password'
                );
        }

        function login()
        {
            //Bereits eingeloggt?
            if($this->Auth->user())
            {
                $this->Session->setFlash('Sie sind bereits eingeloggt. Bitte loggen Sie sich zuerst aus.');
                $this->redirect($this->Auth->redirect());
            }
        }
        function logout()
        {
            $this->redirect($this->Auth->logout());
        }

        function test()
        {
            $user = $this->Auth->user();
            $profile = $this->User->Profile->findByUserId($user['User']['id']);

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