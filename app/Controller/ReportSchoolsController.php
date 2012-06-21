<?php
App::uses('AppController', 'Controller');

class ReportSchoolsController extends AppController
{
    public $components = array('Json');
    
    public function beforeFilter()
    {
        parent::beforeFilter();
        
        if($this->action == 'save' || $this->action == 'delete')
        {
            $this->Security->csrfCheck = false;
            $this->Security->validatePost = false;
            Configure::write('Error.handler', 'JsonError::handleError');
            Configure::write('Exception.handler', 'JsonError::handleException');
        }
    }
    
    public function save()
    {
        if(!isset($this->request->data['report_id']))
            $this->Json->error('Fehler beim Speichern des Schulthemas.', -20, $this->request->data);
        
        $this->loadModel('Report');
        $report = $this->Report->findByIdAndUserId($this->request->data['report_id'], $this->Auth->user('id'));
        $lesson = $this->ReportSchool->findByReportIdAndSubject(
                $report['Report']['id'],
                $this->request->data['subject']);
        
        //Schedule not found?
        if(!$report)
            $this->Json->error('Fehler beim Speichern des Schulthemas. Bericht wurde nicht gefunden.', -30, $this->request->data);
        
        if(isset($lesson['ReportSchool']['id']))
        {
            $lesson['ReportSchool']['text'] = $this->request->data['value'];
            
            if($this->ReportSchool->save($lesson))
            {
                $this->data = $this->ReportSchool->findById($lesson['ReportSchool']['id']);
                $this->Json->response($this->data['ReportSchool']['text'], 11);
            }
            else
                $this->Json->error('Fehler beim Speichern des Schulthemas.', -11, $this->validationErrors);
        }
        else
        {
            $lesson = array(
                'ReportSchool' => array(
                    'report_id' => $report['Report']['id'],
                    'subject' => $this->request->data['subject'],
                    'text' => $this->request->data['value']
                )
            );
            
            $this->ReportSchool->create();
            if($this->ReportSchool->save($lesson))
            {
                $this->data = $this->ReportSchool->findById($this->ReportSchool->getLastInsertId());
                $this->Json->response($this->data['ReportSchool']['text'], 12);
            }
            else
                $this->Json->error('Fehler beim Speichern des Schulthemas.', -12, $this->validationErrors);
        }
    }
    
    public function delete()
    {
        if(!isset($this->request->data['report_id']))
            $this->Json->error('Fehler beim Löschen des Schulthemas.', -20, $this->request->data);
        
        $this->loadModel('Report');
        $report = $this->Report->findByIdAndUserId($this->request->data['report_id'], $this->Auth->user('id'));
        $lesson = $this->ReportSchool->findByReportIdAndSubject(
                $report['Report']['id'],
                $this->request->data['subject']);
        
        //Report not found?
        if(!$report)
            $this->Json->error('Fehler beim Löschen des Schulthemas. Bericht wurde nicht gefunden.', -30, $this->request->data);
        
        if($lesson != null)
        {
            if($this->ReportSchool->delete($lesson['ReportSchool']['id']))
                $this->Json->response('-', 13);
            else
                $this->Json->error('Fehler beim Löschen des Schulthemas.', -13, $this->validationErrors);
        }
        else
            $this->Json->error('Schulthema wurde nicht gefunden, Löschen abgebrochen.', -30, $this->request->data);
    }
}
