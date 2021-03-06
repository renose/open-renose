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
            $this->redirect( array('controller' => 'reports', 'action' => 'display', $year) );
        
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
        $training_end = $profile['Profile']['end_training_period'];
        
        //calc report number
        $report['WeeklyReport']['number'] = $this->DateTime->get_report_number($training_start, $year, $week);
        $report['WeeklyReport']['from'] = $this->DateTime->get_date($year, $week, 1);
        $report['WeeklyReport']['to'] = $this->DateTime->get_date($year, $week, 5);
        
        //get school lessons
        $this->loadModel('Schedule');
        $schedule = $this->Schedule->findByUserId($this->Auth->user('id'));
        $lessons = array();
        
        //school subjects
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
        
        //previous and next report
        $report_previous = null;
        if(strtotime($this->DateTime->get_date($year, $week-1, 1)) >= strtotime($training_start))
        {
            $report_previous['year'] = date('o', strtotime($this->DateTime->get_date($year, $week-1, 1)));
            $report_previous['week'] = date('W', strtotime($this->DateTime->get_date($year, $week-1, 1)));
        }
        
        $report_next = null;
        if(strtotime($this->DateTime->get_date($year, $week+1, 1)) <= strtotime($training_end))
        {
            $report_next['year'] = date('o', strtotime($this->DateTime->get_date($year, $week+1, 1)));
            $report_next['week'] = date('W', strtotime($this->DateTime->get_date($year, $week+1, 1)));
        }

        $this->set('title_for_layout', 'Bericht Nr. ' . $report['WeeklyReport']['number']);
        $this->set('report', $report);
        $this->set('report_previous', $report_previous);
        $this->set('report_next', $report_next);
        $this->set('lessons', $lessons);
    }
    
    function add($year = null, $week = null)
    {
        if(!$year || !$week)
            $this->redirect( array('controller' => 'reports', 'action' => 'display', $year) );
        
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
            $this->redirect( array('controller' => 'reports', 'action' => 'display', $year) );
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
    
    function delete($id)
    {
        $report = $this->WeeklyReport->findByIdAndUserId($id, $this->Auth->user('id'));
        
        $year = null;
        if($report['WeeklyReport']['year'])
            $year = $report['WeeklyReport']['year'];

        if(isset($report['WeeklyReport']['id']))
        {
            if($this->WeeklyReport->delete($report['WeeklyReport']['id']))
                $this->Session->setFlash('Bericht wurde gelöscht.', 'flash_success');
            else
                $this->Session->setFlash('Fehler beim Löschen des Berichts.', 'flash_fail');
        }
        else
            $this->Session->setFlash('Fehler beim Löschen, Bericht nicht gefunden.', 'flash_fail');
        
        $this->redirect( array('controller' => 'reports', 'action' => 'display', $year) );
    }

}