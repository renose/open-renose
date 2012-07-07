<?php

class ProfilesController extends AppController
{
    
    public $components = array('Json');
    protected $ajax_editfileds = array(
        'first_name', 'last_name', 'job_name',
        'street', 'zip_code', 'city',
        'birthday', 'birthplace',
        'company', 'branch',
        'start_training_period', 'end_training_period',
        'contract_signed', 'contract_registered', 'assigned_board_of_trade',
        'past');

    public function beforeFilter()
    {
        parent::beforeFilter();

        if($this->action == 'save')
        {
            $this->Security->csrfCheck = false;
            $this->Security->validatePost = false;
            Configure::write('Error.handler', 'JsonError::handleError');
            Configure::write('Exception.handler', 'JsonError::handleException');
        }
    }

    public function index()
    {
        $this->redirect( array('action' => 'view') );
    }
    
    public function view()
    {
        $this->set('title_for_layout', 'Profil');
        
        $this->loadModel('Job');
        $profile = $this->Profile->findByUserId($this->Auth->user('id'));
        $jobs = $this->Job->find('all', array('recursive' => 0));
        
        if(!isset($profile['Profile']['id']))
            $this->redirect( array('action' => 'add') );

        $job_list = array();
        foreach($jobs as $job)
            $job_list[] = $job['Job']['name'];

        $this->set('jobs', $job_list);
        $this->set('profile', $profile);
    }
    
    function add()
    {
        //Daten setzen
        $this->Profile->create();
        $profile = array();
        $profile['Profile']['user_id'] = $this->Auth->user('id');

        if($this->Profile->save($profile))
        {
            $this->Session->setFlash('Profil wurde erstellt.', 'flash_success');
            $this->redirect( array('action' => 'view') );
        }
        else
        {
            $this->Session->setFlash('Fehler beim Erstellen des Profils.', 'flash_fail');
            $this->redirect('/');
        }
    }
    
    function save()
    {
        if(!isset($this->request->data['id']) || !isset($this->request->data['field']) || !isset($this->request->data['value']))
            $this->Json->error('Fehler beim Speichern.', -20, $this->request->data);
        if(!in_array($this->request->data['field'], $this->ajax_editfileds))
            $this->Json->error('Fehler beim Speichern.', -21, $this->request->data);

        $profile = $this->Profile->findByIdAndUserId($this->request->data['id'], $this->Auth->user('id'));
        $field = $this->request->data['field'];
        $value = $this->request->data['value'];
        
        //job
        if($field === 'job_name')
        {
            $job = $this->Job->findByName($job_name);
            
            if($job != null)
            {
                $field = 'job_id';
                $value = $job['Job']['id'];
            }
            else
                throw new NotImplementedException();
        }

        if(isset($profile['Profile']['id']))
        {
            $this->Profile->id = $profile['Profile']['id'];
            $value = $value != 'null' ? $value : null;

            if($this->Profile->saveField($field, $value))
            {
                $this->data = $this->Profile->findById($profile['Profile']['id']);
                $this->Json->response($this->data['Profile'][$field], 11, $this->data);
            }
            else
                $this->Json->error('Fehler beim Speichern.', -11, $this->request->data);
        }
        else
            $this->Json->error('Fehler beim Speichern.', -30, $this->request->data);
    }
}