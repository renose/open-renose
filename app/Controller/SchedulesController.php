<?php

App::uses('AppController', 'Controller');

class SchedulesController extends AppController
{
    public $components = array('RequestHandler');
    
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
        $lesson_count = 0;
        
        foreach($schedule['ScheduleLesson'] as $lesson)
            $days[$lesson['day']][] = $lesson;
        
        foreach($days as $day)
        {
            if(count($day) > $lesson_count)
                $lesson_count = count($day);
        }
        
        $this->set('schedule', $schedule);
        $this->set('lesson_count', $lesson_count);
        $this->set('days', $days);
    }
    
    public function save()
    {
        $this->loadModel('ScheduleLesson');
        $schedule = $this->Schedule->findByUserId($this->Auth->user('id'));
        $lesson = $this->ScheduleLesson->findByScheduleIdAndDayAndNumber(
                $schedule['Schedule']['id'],
                $this->request->data['day'],
                $this->request->data['number']);
        
        if(isset($lesson['ScheduleLesson']['id']))
        {
            $this->ScheduleLesson->create();
            
            $lesson = array(
                'ScheduleLesson' => array(
                    'schedule_id' => $schedule['Schedule']['id'],
                    'day' => $this->request->data['day'],
                    'number' => $this->request->data['number'],
                    'subject' => $this->request->data['value']
                )
            );
        }
        else
            $lesson['ScheduleLesson']['subject'] = $this->request->data['value'];
        
        if($this->ScheduleLesson->save($lesson))
            echo $lesson['ScheduleLesson']['subject'];
        else
            echo 'ERROR!';
        
        $this->layout = null;
        $this->autoRender = false;
    }
    
    public function delete()
    {
        $this->loadModel('ScheduleLesson');
        $schedule = $this->Schedule->findByUserId($this->Auth->user('id'));
        $lesson = $this->ScheduleLesson->findByScheduleIdAndDayAndNumber(
                $schedule['Schedule']['id'],
                $this->request->data['day'],
                $this->request->data['number']);
        
        if($lesson != null)
        {
            if($this->ScheduleLesson->delete($lesson['ScheduleLesson']['id']))
                echo json_encode(array('status' => 'ok', 'lesson' => null));
            else
                echo json_encode(array('status' => 'error', 'lesson' => $lesson));
        }
        else
            echo json_encode(array('status' => 'not found', 'lesson' => null));
        
        $this->layout = null;
        $this->autoRender = false;
    }

}
