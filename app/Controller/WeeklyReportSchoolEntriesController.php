<?php
App::uses('AppController', 'Controller');

class WeeklyReportSchoolEntriesController extends AppController
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
        
        $this->loadModel('WeeklyReport');
        $report =
            $this->WeeklyReport->find('first', array(
                'conditions' => array(
                    'WeeklyReport.id = ' => $this->request->data['id'],
                    'WeeklyReport.user_id = ' => $this->Auth->user('id')
                    )
            ));
        
        //Schedule not found?
        if(!$report)
            $this->Json->error('Fehler beim Speichern des Schulthemas. Bericht wurde nicht gefunden.', -30, $this->request->data);
        
        $lesson = $this->WeeklyReportSchoolEntry->findByWeeklyReportIdAndSubject(
                $report['WeeklyReport']['id'],
                $this->request->data['subject']);
        
        if(isset($lesson['WeeklyReportSchoolEntry']['id']))
        {
            $lesson['WeeklyReportSchoolEntry']['text'] = $this->request->data['value'];
            
            if($this->WeeklyReportSchoolEntry->save($lesson))
            {
                $this->data = $this->WeeklyReportSchoolEntry->findById($lesson['WeeklyReportSchoolEntry']['id']);
                $this->Json->response($this->data['WeeklyReportSchoolEntry']['text'], 11);
            }
            else
                $this->Json->error('Fehler beim Speichern des Schulthemas.', -11, $this->validationErrors);
        }
        else
        {
            $lesson = array(
                'WeeklyReportSchoolEntry' => array(
                    'weekly_report_id' => $report['WeeklyReport']['id'],
                    'subject' => $this->request->data['subject'],
                    'text' => $this->request->data['value']
                )
            );
            
            $this->WeeklyReportSchoolEntry->create();
            if($this->WeeklyReportSchoolEntry->save($lesson))
            {
                $this->data = $this->WeeklyReportSchoolEntry->findById($this->WeeklyReportSchoolEntry->getLastInsertId());
                $this->Json->response($this->data['WeeklyReportSchoolEntry']['text'], 12);
            }
            else
                $this->Json->error('Fehler beim Speichern des Schulthemas.', -12, $this->validationErrors);
        }
    }
    
    public function delete()
    {
        if(!isset($this->request->data['id']))
            $this->Json->error('Fehler beim Speichern des Schulthemas.', -20, $this->request->data);
        
        $this->loadModel('WeeklyReport');
        $report =
            $this->WeeklyReport->find('first', array(
                'conditions' => array(
                    'WeeklyReport.id = ' => $this->request->data['id'],
                    'WeeklyReport.user_id = ' => $this->Auth->user('id')
                    )
            ));
        $lesson = $this->WeeklyReportSchoolEntry->findByWeeklyReportIdAndSubject(
                $report['WeeklyReport']['id'],
                $this->request->data['subject']);
        
        //Report not found?
        if(!$report)
            $this->Json->error('Fehler beim Löschen des Schulthemas. Bericht wurde nicht gefunden.', -30, $this->request->data);
        
        if($lesson != null)
        {
            if($this->WeeklyReportSchoolEntry->delete($lesson['WeeklyReportSchoolEntry']['id']))
                $this->Json->response('-', 13);
            else
                $this->Json->error('Fehler beim Löschen des Schulthemas.', -13, $this->validationErrors);
        }
        else
            $this->Json->error('Schulthema wurde nicht gefunden, Löschen abgebrochen.', -30, $this->request->data);
    }
}
