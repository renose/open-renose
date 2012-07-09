<?php

class UserSettingsController extends AppController
{
    
    public $components = array('Json');
    protected $ajax_editfileds = array('report_type');

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
        $this->set('title_for_layout', 'Einstellungen');
        
        $settings = $this->UserSetting->findByUserId($this->Auth->user('id'));
        
        if(!isset($settings['UserSetting']['id']))
            $this->redirect( array('action' => 'add') );

        $this->set('settings', $settings);
    }
    
    function add()
    {
        //Daten setzen
        $this->UserSetting->create();
        $settings = array();
        $settings['UserSetting']['user_id'] = $this->Auth->user('id');

        if($this->UserSetting->save($settings))
            $this->redirect( array('action' => 'view') );
        else
        {
            $this->Session->setFlash('Fehler beim Erstellen der Einstellungen.', 'flash_fail');
            $this->redirect('/');
        }
    }
    
    function save()
    {
        if(!isset($this->request->data['id']) || !isset($this->request->data['field']) || !isset($this->request->data['value']))
            $this->Json->error('Fehler beim Speichern.', -20, $this->request->data);
        if(!in_array($this->request->data['field'], $this->ajax_editfileds))
            $this->Json->error('Fehler beim Speichern.', -21, $this->request->data);

        $settings = $this->UserSetting->findByIdAndUserId($this->request->data['id'], $this->Auth->user('id'));
        $field = $this->request->data['field'];
        $value = $this->request->data['value'];

        if(isset($settings['UserSetting']['id']))
        {
            $this->Profile->id = $settings['UserSetting']['id'];
            $value = $value != 'null' ? $value : null;

            if($this->UserSetting->saveField($field, $value))
            {
                $this->data = $this->UserSetting->findById($settings['UserSetting']['id']);
                $this->Json->response($this->data['UserSetting'][$field], 11, $this->data);
            }
            else
                $this->Json->error('Fehler beim Speichern.', -11, $this->request->data);
        }
        else
            $this->Json->error('Fehler beim Speichern.', -30, $this->request->data);
    }
}