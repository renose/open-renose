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
    
    public function view($year, $week)
    {
        $report =
            $this->ReportWeek->find('first', array(
                'conditions' => array(
                    'Report.user_id = ' => $this->Auth->user('id'),
                    'Report.year = ' => $year,
                    'Report.week = ' => $week)
            ));
        
        //create report if not exsists
        if(!isset($report['Report']['id']))
            $this->redirect( array('controller' => 'reports', 'action' => 'add', $report['Report']['year'], $report['Report']['week']) );
        
        //get user proflie
        $this->loadModel('Profile');
        $profile = $this->Profile->findByUserId($this->Auth->user('id'));
        $training_start = $profile['Profile']['start_training_period'];
        
        //calc report number
        $report['Report']['number'] = $this->DateTime->get_report_number($training_start, $year, $week);
        
        //get school lessons
        $this->loadModel('Schedule');
        $schedule = $this->Schedule->findByUserId($this->Auth->user('id'));
        $lessons = array();

        if($schedule)
        {
            $this->loadModel('ScheduleLesson');
            $schedule_lessons = $this->ScheduleLesson->find('all', array(
                'conditions' => array('Schedule.id' => $schedule['Schedule']['id']),
                'group' => 'ScheduleLesson.subject'
            ));

            foreach ($schedule_lessons as $lesson)
                $lessons[$lesson['ScheduleLesson']['subject']] = null;
        }

        foreach ($report['ReportWeekSchoolSubject'] as $lesson)
            $lessons[$lesson['subject']] = $lesson['text'];

        $this->set('title_for_layout', 'Bericht Nr. ' . $report['Report']['number']);
        $this->set('report', $report);
        $this->set('lessons', $lessons);
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