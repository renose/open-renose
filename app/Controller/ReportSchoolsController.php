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
            $this->Json->error('Fehler beim Speichern des Schulthemas. Bericht wurde nicht gefunden.', -30, array('report' => $report, 'lesson' => $lesson));
        
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
        if(!isset($this->request->data['day']) || !isset($this->request->data['number']))
            $this->Json->error('Fehler beim Löschen der Stunde.', -20, $this->request->data);
        
        $this->loadModel('ScheduleLesson');
        $schedule = $this->Schedule->findByUserId($this->Auth->user('id'));
        $lesson = $this->ScheduleLesson->findByScheduleIdAndDayAndNumber(
                $schedule['Schedule']['id'],
                $this->request->data['day'],
                $this->request->data['number']);
        
        //Schedule not found?
        if(!$schedule)
            $this->Json->error('Fehler beim Löschen der Stunde. Stundenplan wurde nicht gefunden.', -30, array('schedule' => $schedule, 'lesson' => $lesson));
        
        if($lesson != null)
        {
            if($this->ScheduleLesson->delete($lesson['ScheduleLesson']['id']))
                $this->Json->response('-', 13);
            else
                $this->Json->error('Fehler beim Löschen der Stunde.', -13, $this->validationErrors);
        }
        else
            $this->Json->error('Stunde wurde nicht gefunden, Löschen abgebrochen.', -30, $this->request->data);
    }
}
