<?php
/*
 * reports_controller.php
 *
 * Copyright (c) 2011 open reNose team <info at renose.de>.
 * Simon Wörner and Patrick Hafner.
 *
 * This file is part of open reNose.
 *
 * open reNose is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * open reNose is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with open reNose.  If not, see <http ://www.gnu.org/licenses/>.
 */

class ReportsController extends AppController
{

    public $helpers = array('Time', 'reNoseDate', 'Form');
    public $components = array('PdfGenerator', 'Json', 'DateTime');
    
    protected $ajax_editfileds = array('date', 'department');

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

        if($this->request->params['action'] == 'export') {
            if(!in_array('curl', get_loaded_extensions())) {
                throw new InternalErrorException('cURL wurde nicht gefunden. Dieses Modul wird für den PDF Generator benötigt.');
                $this->render();
            }

            if($this->request->is('post') || isset($this->request->params['pass'][0])) {
                header('Content-Type: application/pdf');
                $this->layout = false;
                $this->autoRender = false;
                set_time_limit(0);
                ini_set('memory_limit', '512M');
            }

        }
    }

    function index()
    {
        $this->redirect(array('action' => 'display'));
    }

    public function display($year = null)
    {
        $this->set('title_for_layout', 'Berichte Verwalten');

        //Kein Jahr übergeben => dieses Jahr nehmen
        if(!$year)
            $year = date('Y');
        
        //get reprots
        $reports = $this->Report->find('all', array(
            'order' => array('Report.year ASC', 'Report.week ASC'),
            'conditions' => array(
                'Report.user_id = ' => $this->Auth->user('id'),
                'Report.year = ' => $year),
        ));
        
        //get user proflie
        $this->loadModel('Profile');
        $profile = $this->Profile->findByUserId($this->Auth->user('id'));
        $training_start = $profile['Profile']['start_training_period'];
        
        foreach ($reports as $report)
        $week_reports[$report['Report']['year']][$report['Report']['week']] = $report;
        
        //reorder reports and calc report number
        $week_reports = array();
        for($i = 0; $i < count($reports); $i++)
        {
            $year = $reports[$i]['Report']['year'];
            $week = $reports[$i]['Report']['week'];
            
            //calc report number
            $reports[$i]['Report']['number'] = $this->DateTime->get_report_number($training_start, $year, $week);
            
            //add to year-week list
            $week_reports[$year][$week] = $reports[$i]['Report'];
            
            //weekly reports
            if(true)
            {
                $activity = $reports[$i]['ReportWeek']['activity'] != null;
                $instruction = $reports[$i]['ReportWeek']['instruction'] != null;
                //$school = count($reports[$i]['ReportWeek']['ReportWeekSchoolTopics']) > 0 || $reports[$i]['Report']['holiday'];
                $school = false;
                $status = null;
                
                if($activity && $instruction && $school)
                    $status = 'full';
                else if($activity || $instruction || $school)
                    $status = 'half';
                else
                    $status = 'missing';
                
                $week_reports[$year][$week]['status'] = $status;
            }
        }

        //get calendar entries
        $this->loadModel('CalendarEntry');
        $calendar_entries = $this->CalendarEntry->find('all', array(
            'recursive' => 0,
            'conditions' => array(
                'CalendarEntry.user_id = ' => $this->Auth->user('id'),
                'CalendarEntry.day > ' => "$year-01-01",
                'CalendarEntry.day < ' => "$year-12-31"),
            'fields' => array('CalendarEntry.day', 'CalendarEntry.type')
        ));
        $calendar = array();
        
        //sort calendar entries
        foreach($calendar_entries as $entry)
            $calendar[$entry['CalendarEntry']['day']][] = $entry['CalendarEntry']['type'];

        $this->set('year', $year);
        $this->set('calendar', $calendar);
        $this->set('reports', $week_reports);
    }

    public function view($year = null, $week = null)
    {
        if(!$year || !$week)
            $this->redirect( array('action' => 'display', $year) );
        
        $report =
            $this->Report->find('first', array(
                'conditions' => array(
                    'Report.user_id = ' => $this->Auth->user('id'),
                    'Report.year = ' => $year,
                    'Report.week = ' => $week)
            ));
        
        //create report if not exsists
        if(!isset($report['Report']['id']))
            $this->redirect( array('action' => 'add', $year, $week) );
        
        //weekly reports
        if(true)
            $this->redirect( array('controller' => 'report_weeks', 'action' => 'view', $year, $week) );
    }

    function add($year = null, $week = null)
    {
        if(!$year || !$week)
            $this->redirect( array('action' => 'display', $year) );
        
        //Search last report
        $last_report =
            $this->Report->find('all', array(
            'order' => array('Report.year DESC', 'Report.week DESC'),
            'conditions' => array(
                'Report.user_id = ' => $this->Auth->user('id'),
                'Report.year < ' => $year,
                'Report.week < ' => $week),
        ));

        //Daten setzen
        $this->Report->create();
        $report = array();
        $report['Report']['user_id'] = $this->Auth->user('id');
        $report['Report']['year'] = $year;
        $report['Report']['week'] = $week;
        $report['Report']['department'] = '';
        $report['Report']['date'] = date('Y-m-d');

        if(isset($last_report['Report']['department']))
            $report['Report']['department'] = $last_report['Report']['department'];

        if($this->Report->save($report))
        {
            $this->Session->setFlash('Bericht wurde erstellt.', 'flash_success');
            $this->redirect( array('action' => 'view', $report['Report']['year'], $report['Report']['week']) );
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

        $this->loadModel('Report');
        $report = $this->Report->findByIdAndUserId($this->request->data['id'], $this->Auth->user('id'));
        $field = $this->request->data['field'];
        $value = $this->request->data['value'];
        

        if(isset($report['Report']['id']))
        {
            $this->Report->id = $report['Report']['id'];
            $value = $value != 'null' ? $value : null;

            if($this->Report->saveField($field, $value))
            {
                $this->data = $this->Report->findById($report['Report']['id']);
                $this->Json->response($this->data['Report'][$field], 11, $this->data);
            }
            else
                $this->Json->error('Fehler beim Speichern.', -11, $this->request->data);
        }
        else
            $this->Json->error('Fehler beim Speichern: Bericht wurde nicht gefunden.', -30, $this->request->data);
    }

    // pdfgen
    public function export($reportId = NULL, $debug = NULL) {

        if($this->request->is('post') || ($reportId != NULL)) {
            $oneReport = false;

            App::import('Vendor', 'tcpdf/config/lang/ger');
            App::import('Vendor', 'tcpdf/tcpdf');

            // load user model for data
            $this->loadModel('User');

            $userProfile = $this->User->Profile->findByUserId($this->Auth->user('id'));
            #ChromePhp::log($userProfile);

            if(($reportId)) {
                $reportId = intval($reportId);
                // generate only one report
                $oneReport = true;

                $reports = $this->Report->find('all', array(
                    'conditions' => array(
                        'User.id = ' => $this->Auth->user('id'),
                        'Report.id' => $reportId
                        ),
                        'fields' => array(
                            'Report.date',
                            'Report.number',
                            'Report.year',
                            'Report.week',
                            'Report.number'
                        ),
                    'recursive' => 0,
                ));

            } else {
                $reports = $this->Report->find('all', array(
                    'conditions' => array(
                        'User.id = ' => $this->Auth->user('id'),
                        ),
                        'fields' => array(
                            'Report.date',
                            'Report.number',
                            'Report.year',
                            'Report.week',
                            'Report.number',
                            'Report.department'
                        ),
                    'recursive' => 0,
                    'order' => array(
                        'Report.year' => 'asc',
                        'Report.number' => 'asc',
                        'Report.week' => 'asc'
                    )
                ));
            }

            if(!$reports) {
                // no records found
                Throw new ForbiddenException('Kein Datensatz gefunden, oder nicht berechtigt.');
            }



            $this->set('templatePath', '/reportExportTemplates/ihk/');

            $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
            $pdf->SetCreator('reNose.de');
            //$pdf->SetAuthor($userProfile['full_name']);
            //$pdf->SetTitle('Berichtsheft von '.$userProfile['full_name']);

            $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
            $pdf->SetMargins(PDF_MARGIN_LEFT, 15, PDF_MARGIN_RIGHT);

            // disable header
            $pdf->setPrintHeader(false);

            // disable footer
            $pdf->setPrintFooter(false);
            //$pdf->SetFont('Arial', 'B', 20);


            // write first site which contains personal data
            // TODO
            $this->set('user', $userProfile);

            if(isset($this->request->data['Report']['overview']) && $this->request->data['Report']['overview'] == 1) {
                // generate overview

                // add a page
                $pdf->AddPage();

                $pdf->writeHTML($this->render('reportExportTemplates/ihk/overview'), true);
            }

            if(isset($this->request->data['Report']['activityList']) && $this->request->data['Report']['activityList'] == 1) {
                // generate activityList

                // set report overview for activityList
                $this->set('reports', $reports);
                $sizeOfReports = sizeof($reports);

                // max 31 records per page (A4)
                $pageCounter = ceil($sizeOfReports / 31);

                // fresh rendering for every page
                for($i=0;$i<$pageCounter;$i++) {
                    $pdf->AddPage();

                    $this->set('start', $i*31);
                    $this->set('end', ($i+1)* 31);

                    $pdf->writeHTML($this->render('reportExportTemplates/ihk/activityList'), true);
                }
            }


            if((isset($this->request->data['Report']['allReports']) && $this->request->data['Report']['allReports'] == 1) || $oneReport) {

                // generate detailed week view

                foreach($reports as $report) {
                    $fullReportData = $this->Report->find('first', array(
                        'conditions' => array(
                            'Report.id' => $report['Report']['id']
                        )
                    ));

                    $pdf->AddPage();
                    $pdf->SetAutoPageBreak(true, 0.5);

                    // write first header
                    $this->set('report', $fullReportData['Report']);
                    $pdf->writeHTML($this->render('reportExportTemplates/ihk/detailHeader'), true);


                    // ReportActivity
                    $activity = array(
                        'title' => 'Betriebliche Tätigkeit',
                        'text' => $fullReportData['ReportActivity']['text']
                    );

                    $this->set('detail', $activity);
                    $pdf->writeHTML($this->render('reportExportTemplates/ihk/detailElement'), false);

                    unset($activity);

                    // ReportInstruction
                    $instruction = array(
                        'title' => 'Themen von Unterweisungen, Lehrgesprächen, betrieblichem Unterricht und außerbetrieblichen Schulungsveranstaltungen',
                        'text' => $fullReportData['ReportInstruction']['text']
                    );
                    $this->set('detail', $instruction);
                    $pdf->writeHTML($this->render('reportExportTemplates/ihk/detailElement'), false);

                    unset($instruction);


                    // school
                    if($fullReportData['Report']['holiday'] == 1) {
                        $school = array(
                        'title' => 'Berufsschule (Themen des Unterrichts in den einzelnen Fächern)',
                            'text' => 'Urlaub / Ferien'
                        );
                    } else {
                        $school = array(
                            'title' => 'Berufsschule (Themen des Unterrichts in den einzelnen Fächern)',
                            'text' => $this->PdfGenerator->prepareSchoolTextWithTitleAndText($fullReportData['ReportSchool'], 'subject', 'text')
                        );
                    }

                    $this->set('detail', $school);
                    $pdf->writeHTML($this->render('reportExportTemplates/ihk/detailElement'), false);

                    unset($school);

                    $pdf->writeHTML($this->render('reportExportTemplates/ihk/detailFooter'), true);

                    unset($fullReportData);

                }

            }

            // kick it out
            header('Content-Type: application/pdf');
            if(!isset($debug)) $pdf->Output('pdf.pdf', 'I');
        }

    }

    private function __setExportTemplate() {}

}