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
        $this->loadModel('Job');
        $profile = $this->Profile->findByUserId($this->Auth->user('id'));
        $jobs = $this->Job->find('all', array('recursive' => 0));
        $this->set('title_for_layout', 'Profil');


        $job_list = array();
        foreach($jobs as $job)
            $job_list[] = $job['Job']['name'];

        //Daten eingegeben? => Speichern
        if (!empty($this->request->data))
        {
            if(!isset($profile['Profile']['user_id']))
                $this->request->data['Profile']['user_id'] = $this->Auth->user('id');

            $job_name = $this->request->data['Profile']['job_name'];
            $job = $this->Job->findByName($job_name);

            if($job != null)
                $this->request->data['Profile']['job_id'] = $job['Job']['id'];
            else
                $this->request->data['Job']['name'] = $job_name;

            if ($this->Profile->saveAssociated($this->request->data))
            {
                $this->Session->setFlash('Dein Profil wurde gespeichert.', 'flash_success');
                $this->redirect( array('controller' => 'profiles', 'action' => 'index') );
            }
            else
                $this->Session->setFlash('Fehler beim Speichern des Profils.');
        }
        else
        {
            if(isset($profile['Job']['name']))
                $profile['Profile']['job_name'] = $profile['Job']['name'];
            
            $this->request->data = $profile;
        }

        $this->set('jobs', $job_list);
        $this->set('profile', $profile);
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
            $this->Json->error('Fehler beim Speichern: Bericht wurde nicht gefunden.', -30, $this->request->data);
    }
}