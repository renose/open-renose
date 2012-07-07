<?php

App::uses('AppController', 'Controller');

class SchedulesController extends AppController
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
    
    public function index()
    {
        $this->redirect( array('action' => 'view') );
    }
    
    public function view()
    {
        $schedule = $this->_findCreateSchedule();
        $days = array();
        $max_lesson = 0;
        
        foreach($schedule['ScheduleLesson'] as $lesson)
        {
            $days[$lesson['day']][$lesson['number']] = $lesson;
            
            if($lesson['number'] > $max_lesson)
                $max_lesson = $lesson['number'];
        }
        
        $this->set('schedule', $schedule);
        $this->set('days', $days);
        $this->set('max_lesson', $max_lesson);
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
        
        //Schedule not found?
        if(!$schedule)
            $this->Json->error('Fehler beim Speichern der Stunde. Stundenplan wurde nicht gefunden.', -30, $this->request->data);
        
        if(isset($lesson['ScheduleLesson']['id']))
        {
            $lesson['ScheduleLesson']['subject'] = $this->request->data['value'];
            
            if($this->ScheduleLesson->save($lesson))
            {
                $this->data = $this->ScheduleLesson->findById($lesson['ScheduleLesson']['id']);
                $this->Json->response($this->data['ScheduleLesson']['subject'], 11);
            }
            else
                $this->Json->error('Fehler beim Speichern der Stunde.', -11, $this->validationErrors);
        }
        else
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
            if($this->ScheduleLesson->save($lesson))
            {
                $this->data = $this->ScheduleLesson->findById($this->ScheduleLesson->getLastInsertId());
                $this->Json->response($this->data['ScheduleLesson']['subject'], 12);
            }
            else
                $this->Json->error('Fehler beim Speichern der Stunde.', -12, $this->validationErrors);
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
    
    private function _findCreateSchedule()
    {
        $schedule = $this->Schedule->findByUserId($this->Auth->user('id'));
        
        if($schedule)
            return $schedule;
        else
        {
            $this->Schedule->create();
            $schedule = array(
                'Schedule' => array(
                    'user_id' => $this->Auth->user('id')
                )
            );
            $this->Schedule->save($schedule);
            
            $schedule = $this->Schedule->findByUserId($this->Auth->user('id'));
            return $schedule;
        }
    }
}
