<?php
App::uses('AppController', 'Controller');

class ReportWeekSchoolSubjectsController extends AppController
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
        if(!isset($this->request->data['id']) || !isset($this->request->data['value']))
            $this->Json->error('Fehler beim Speichern des Schulthemas.', -20, $this->request->data);
        if($this->request->data['value'] == null || $this->request->data['value'] == '')
            $this->Json->error('Fehler beim Speichern: Bitte geben Sie einen Text ein.', -21, $this->request->data);
        
        $this->loadModel('ReportWeek');
        $report =
            $this->ReportWeek->find('first', array(
                'conditions' => array(
                    'ReportWeek.id = ' => $this->request->data['id'],
                    'Report.user_id = ' => $this->Auth->user('id')
                    )
            ));
        $lesson = $this->ReportWeekSchoolSubject->findByReportWeekIdAndSubject(
                $report['ReportWeek']['id'],
                $this->request->data['subject']);
        
        //Schedule not found?
        if(!$report)
            $this->Json->error('Fehler beim Speichern des Schulthemas. Bericht wurde nicht gefunden.', -30, $this->request->data);
        
        if(isset($lesson['ReportWeekSchoolSubject']['id']))
        {
            $lesson['ReportWeekSchoolSubject']['text'] = $this->request->data['value'];
            
            if($this->ReportWeekSchoolSubject->save($lesson))
            {
                $this->data = $this->ReportWeekSchoolSubject->findById($lesson['ReportWeekSchoolSubject']['id']);
                $this->Json->response($this->data['ReportWeekSchoolSubject']['text'], 11);
            }
            else
                $this->Json->error('Fehler beim Speichern des Schulthemas.', -11, $this->validationErrors);
        }
        else
        {
            $lesson = array(
                'ReportWeekSchoolSubject' => array(
                    'report_week_id' => $report['ReportWeek']['id'],
                    'subject' => $this->request->data['subject'],
                    'text' => $this->request->data['value']
                )
            );
            
            $this->ReportWeekSchoolSubject->create();
            if($this->ReportWeekSchoolSubject->save($lesson))
            {
                $this->data = $this->ReportWeekSchoolSubject->findById($this->ReportWeekSchoolSubject->getLastInsertId());
                $this->Json->response($this->data['ReportWeekSchoolSubject']['text'], 12);
            }
            else
                $this->Json->error('Fehler beim Speichern des Schulthemas.', -12, $this->validationErrors);
        }
    }
    
    public function delete()
    {
        if(!isset($this->request->data['id']))
            $this->Json->error('Fehler beim Speichern des Schulthemas.', -20, $this->request->data);
        
        $this->loadModel('ReportWeek');
        $report =
            $this->ReportWeek->find('first', array(
                'conditions' => array(
                    'ReportWeek.id = ' => $this->request->data['id'],
                    'Report.user_id = ' => $this->Auth->user('id')
                    )
            ));
        $lesson = $this->ReportWeekSchoolSubject->findByReportWeekIdAndSubject(
                $report['ReportWeek']['id'],
                $this->request->data['subject']);
        
        //Report not found?
        if(!$report)
            $this->Json->error('Fehler beim Löschen des Schulthemas. Bericht wurde nicht gefunden.', -30, $this->request->data);
        
        if($lesson != null)
        {
            if($this->ReportWeekSchoolSubject->delete($lesson['ReportWeekSchoolSubject']['id']))
                $this->Json->response('-', 13);
            else
                $this->Json->error('Fehler beim Löschen des Schulthemas.', -13, $this->validationErrors);
        }
        else
            $this->Json->error('Schulthema wurde nicht gefunden, Löschen abgebrochen.', -30, $this->request->data);
    }
}
