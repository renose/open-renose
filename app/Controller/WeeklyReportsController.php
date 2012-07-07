<?php

class WeeklyReportsController extends AppController
{

    public $components = array('Json', 'DateTime');
    protected $ajax_editfileds = array('date', 'department', 'vacation', 'holiday', 'activity', 'instruction');

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
    
    public function view($year = null, $week = null)
    {
        if(!$year || !$week)
            $this->redirect( array('action' => 'display', $year) );
        
        $report =
            $this->WeeklyReport->find('first', array(
                'conditions' => array(
                    'WeeklyReport.user_id = ' => $this->Auth->user('id'),
                    'WeeklyReport.year = ' => $year,
                    'WeeklyReport.week = ' => $week)
            ));
        
        //create report_week if not exsists
        if(!isset($report['WeeklyReport']['id']))
            $this->redirect( array('action' => 'add', $year, $week) );
        
        //get user proflie
        $this->loadModel('Profile');
        $profile = $this->Profile->findByUserId($this->Auth->user('id'));
        $training_start = $profile['Profile']['start_training_period'];
        
        //calc report number
        $report['WeeklyReport']['number'] = $this->DateTime->get_report_number($training_start, $year, $week);
        
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

        foreach ($report['WeeklyReportSchoolEntry'] as $lesson)
            $lessons[$lesson['subject']] = $lesson['text'];

        $this->set('title_for_layout', 'Bericht Nr. ' . $report['WeeklyReport']['number']);
        $this->set('report', $report);
        $this->set('lessons', $lessons);
    }
    
    function add($year = null, $week = null)
    {
        if(!$year || !$week)
            $this->redirect( array('action' => 'display', $year) );
        
        //Search last report
        $last_report =
            $this->WeeklyReport->find('first', array(
            'order' => array('WeeklyReport.year DESC', 'WeeklyReport.week DESC'),
            'conditions' => array(
                'WeeklyReport.user_id = ' => $this->Auth->user('id'),
                'WeeklyReport.year <= ' => $year,
                'WeeklyReport.week < ' => $week),
        ));

        //Daten setzen
        $this->WeeklyReport->create();
        $report = array();
        $report['WeeklyReport']['user_id'] = $this->Auth->user('id');
        $report['WeeklyReport']['year'] = $year;
        $report['WeeklyReport']['week'] = $week;
        $report['WeeklyReport']['department'] = '';
        $report['WeeklyReport']['date'] = date('Y-m-d');

        if(isset($last_report['WeeklyReport']['department']))
            $report['WeeklyReport']['department'] = $last_report['WeeklyReport']['department'];

        if($this->WeeklyReport->save($report))
        {
            $this->Session->setFlash('Bericht wurde erstellt.', 'flash_success');
            $this->redirect( array('action' => 'view', $year, $week) );
        }
        else
        {
            $this->Session->setFlash('Fehler beim Erstellen des Berichtes.', 'flash_fail');
            $this->redirect( array('action' => 'display', $year) );
        }
    }

    function save()
    {
        if(!isset($this->request->data['id']) || !isset($this->request->data['field']) || !isset($this->request->data['value']))
            $this->Json->error('Fehler beim Speichern.', -20, $this->request->data);
        if(!in_array($this->request->data['field'], $this->ajax_editfileds))
            $this->Json->error('Fehler beim Speichern.', -21, $this->request->data);

        $report = $this->WeeklyReport->findByIdAndUserId($this->request->data['id'], $this->Auth->user('id'));
        $field = $this->request->data['field'];
        $value = $this->request->data['value'];

        if(isset($report['WeeklyReport']['id']))
        {
            $this->WeeklyReport->id = $report['WeeklyReport']['id'];
            $value = $value != 'null' ? $value : null;

            if($this->WeeklyReport->saveField($field, $value))
            {
                $this->data = $this->WeeklyReport->findById($report['WeeklyReport']['id']);
                $this->Json->response($this->data['WeeklyReport'][$field], 11, $this->data);
            }
            else
                $this->Json->error('Fehler beim Speichern.', -11, $this->request->data);
        }
        else
            $this->Json->error('Fehler beim Speichern: Bericht wurde nicht gefunden.', -30, $this->request->data);
    }

}