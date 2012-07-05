<?php

class ReportWeeksController extends AppController
{

    public $components = array('Json', 'DateTime');
    
    protected $ajax_editfileds = array('vacation', 'holiday', 'activity', 'instruction');

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

    function save()
    {
        if(!isset($this->request->data['id']) || !isset($this->request->data['field']) || !isset($this->request->data['value']))
            $this->Json->error('Fehler beim Speichern.', -20, $this->request->data);
        if(!in_array($this->request->data['field'], $this->ajax_editfileds))
            $this->Json->error('Fehler beim Speichern.', -21, $this->request->data);

        $this->loadModel('Report');
        $report = $this->Report->findByIdAndUserId($this->request->data['id'], $this->Auth->user('id'));
        $field = $this->request->data['field'];
        $value = $this->request->data['value'];

        if(isset($report['Report']['id']))
        {
            $value = $value != 'null' ? $value : null;
            
            if(!isset($report['ReportWeek']['id']))
            {
                $report['ReportWeek'] = array(
                    'report_id' => $report['Report']['id'],
                    $field => $value
                );
                
                $this->ReportWeek->create($report);
                $this->ReportWeek->save($report);
                
                $this->data = $this->ReportWeek->findById($this->ReportWeek->getLastInsertId());
                $this->Json->response($this->data['ReportWeek'][$field], 12, $this->data);
            }
            else
            {
                $this->ReportWeek->id = $report['ReportWeek']['id'];

                if($this->ReportWeek->saveField($field, $value))
                {
                    $this->data = $this->ReportWeek->findById($report['ReportWeek']['id']);
                    $this->Json->response($this->data['ReportWeek'][$field], 11, $this->data);
                }
                else
                    $this->Json->error('Fehler beim Speichern.', -11, $this->request->data);
            }
        }
        else
            $this->Json->error('Fehler beim Speichern: Bericht wurde nicht gefunden.', -30, $this->request->data);
    }

}