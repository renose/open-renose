<?php

App::uses('AppController', 'Controller');

class SchedulesController extends AppController
{
    public $components = array('RequestHandler', 'Json');
    
    public function beforeFilter()
    {
        parent::beforeFilter();
        
        if($this->action == 'save' || $this->action == 'delete')
        {
            $this->Security->csrfCheck = false;
            $this->Security->validatePost = false;
        }
    }
    
    public function index()
    {
        $schedule = $this->Schedule->find('first');
        $days = array();
        
        foreach($schedule['ScheduleLesson'] as $lesson)
            $days[$lesson['day']][$lesson['number']] = $lesson;
        
        $this->set('schedule', $schedule);
        $this->set('days', $days);
    }
    
    public function save()
    {
        if(!isset($this->request->data['day']) || !isset($this->request->data['number']) || !isset($this->request->data['value']))
            $this->Json->error('Fehler beim Speichern der Stunde.', -20, $this->request->data);
        if($this->request->data['value'] == null || $this->request->data['value'] == '')
            $this->Json->error('Fehler beim Speichern der Stunde.', -21, $this->request->data);
        
        $this->loadModel('ScheduleLesson');
        $schedule = $this->Schedule->findByUserId($this->Auth->user('id'));
        $lesson = $this->ScheduleLesson->findByScheduleIdAndDayAndNumber(
                $schedule['Schedule']['id'],
                $this->request->data['day'],
                $this->request->data['number']);
        
        if(!isset($lesson['ScheduleLesson']['id']))
        {
            $lesson = array(
                'ScheduleLesson' => array(
                    'schedule_id' => $schedule['Schedule']['id'],
                    'day' => $this->request->data['day'],
                    'number' => $this->request->data['number'],
                    'subject' => $this->request->data['value']
                )
            );
            
            $this->ScheduleLesson->create();
        }
        else
            $lesson['ScheduleLesson']['subject'] = $this->request->data['value'];
        
        if($this->ScheduleLesson->save($lesson))
        {
            $this->data = $this->ScheduleLesson->findById($lesson['ScheduleLesson']['id']);
            $this->Json->response($this->data['ScheduleLesson']['subject'], 10);
        }
        else
            $this->Json->error('Fehler beim Speichern der Stunde.', -10, $this->validationErrors);
        
        $this->layout = null;
        $this->autoRender = false;
    }
    
    public function delete()
    {
        if(!isset($this->request->data['day']) || !isset($this->request->data['number']))
            $this->Json->error('Fehler beim Speichern der Stunde.', -20, $this->request->data);
        
        $this->loadModel('ScheduleLesson');
        $schedule = $this->Schedule->findByUserId($this->Auth->user('id'));
        $lesson = $this->ScheduleLesson->findByScheduleIdAndDayAndNumber(
                $schedule['Schedule']['id'],
                $this->request->data['day'],
                $this->request->data['number']);
        
        if($lesson != null)
        {
            if($this->ScheduleLesson->delete($lesson['ScheduleLesson']['id']))
                $this->Json->response(null, 13);
            else
                $this->Json->error('Fehler beim Löschen der Stunde.', -13, $this->validationErrors);
        }
        else
            $this->Json->error('Stunde wurde nicht gefunden, Löschen abgebrochen.', -30, $this->request->data);
    }

}
