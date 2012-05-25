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

error_reporting(E_ALL);
App::import('Vendor', 'tcpdf/config/lang/ger');
App::import('Vendor', 'tcpdf/tcpdf');

class ReportsController extends AppController
{

    public $scaffold;

    public $helpers = array('Time', 'reNoseDate');
    public $components = array('PdfGenerator');

    public function beforeFilter()
    {
        parent::beforeFilter();
        if($this->request->params['action'] == 'export') {
            #header('Content-type: application/pdf');
            $this->layout = false;
            $this->autoRender = false;
            set_time_limit(0);
            ini_set('memory_limit', '512M');
        }
    }

    public function beforeRender()
    {
        parent::beforeRender();
        #header('Content-type: application/pdf');
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

        $this->set('year', $year);
        $this->set('reports', $this->Report->find('all', array(
            'order' => 'Report.number ASC',
            'conditions' => array(
                'User.id = ' => $this->Auth->user('id'),
                'Report.year = ' => $year)
        )));
    }

    public function view($year, $week)
    {
        $report =
            $this->Report->find('first', array(
                'conditions' => array(
                    'User.id = ' => $this->Auth->user('id'),
                    'Report.year = ' => $year,
                    'Report.week = ' => $week)
            ));

        $this->set('title_for_layout', 'Bericht Nr. ' . $report['Report']['number']);
        $this->set('report', $report);
    }

    function add($year = null, $week = null)
    {
        $this->set('title_for_layout', 'Bericht erstellen');

        if(!$year)
            $year = date('Y');

        if(!$week)
            $week = date('W');

        if (!empty($this->request->data))
        {
            $this->request->data['Report']['user_id'] = $this->Auth->user('id');

            if ($this->Report->save($this->request->data))
            {
                $this->Session->setFlash('Ihr Bericht wurde erstellt.', 'flash_success');
                $this->redirect( array('action' => 'view', $this->request->data['Report']['year'], $this->request->data['Report']['week']) );
            }
        }
        else
        {
            //Nummer auf 1 setzen falls nicht bestimmt werden kann oder erster Bericht erstellt wird
            $number = 1;

            //Ersten Bericht suchen
            $first_report =
                $this->Report->find('first', array(
                    'order' => 'Report.number ASC',
                    'conditions' => array('User.id = ' => $this->Auth->user('id'))
                ));

            //Erster Bericht vorhanden? Nummer berechnen
            if($first_report != null)
            {
                //Bericht VOR erstem erstellen
                if($year < $first_report['Report']['year'])
                    pr('FUCK OFF!!');
                //Bericht im selben Jahr wie erster
                else if($year == $first_report['Report']['year'])
                {
                    //Bericht VOR erstem erstellen
                    if($week < $first_report['Report']['week'])
                        pr('FUCK OFF!!');
                    //Bericht gleich wie erster erstellen
                    else if($week == $first_report['Report']['week'])
                        pr('FUCK OFF!!');
                    //Bericht NACH erstem erstellen
                    else
                        $number = $first_report['Report']['number'] + $week - $first_report['Report']['week'];
                }
                else
                {
                    //Wochen des ersten Jahres berechnen
                    $number = $first_report['Report']['number'] + date('W', mktime(0, 0, 0, 12, 31, $first_report['Report']['year'])) - $first_report['Report']['week'];

                    //Volle Jahre addieren
                    for($i = $first_report['Report']['year'] + 1; $i < $year; $i++)
                        $number += date('W', mktime(0, 0, 0, 12, 1, $i));

                    //Wochen des letzten Jahres addieren
                    $number += $week;
                }
            }

            //Daten setzen
            $this->request->data['Report']['year'] = $year;
            $this->request->data['Report']['week'] = $week;
            $this->request->data['Report']['number'] = $number;
        }
    }


    // pdfgen
    public function export($debug = NULL) {
        // load user model for data
        $this->loadModel('User');

        $userProfile = $this->User->Profile->findByUserId($this->Auth->user('id'));

        $reports = $this->Report->find('all', array(
            'conditions' => array(
                'User.id = ' => $this->Auth->user('id'),
                ),
                'fields' => array(
                    'Report.date',
                    'Report.number',
                    'Report.year',
                    'Report.week',
                    'Report.number'
                ),
            'recursive' => 0,
            'order' => array(
                'Report.number' => 'asc'
            )
        ));

        $this->set('templatePath', '/reportExporttemplates/ihk/');

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

        // add a page
        $pdf->AddPage();

        // write first site which contains personal data
        // TODO
        $pdf->writeHTML($this->render('reportExportTemplates/ihk/overview'), true);

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
                'text' => $this->PdfGenerator->mergeTextFromArray($fullReportData['ReportActivity'], 'text')
            );

            $this->set('detail', $activity);
            $pdf->writeHTML($this->render('reportExportTemplates/ihk/detailElement'), false);

            unset($activity);

            // ReportInstruction
            $instruction = array(
                'title' => 'Themen von Unterweisungen, Lehrgesprächen, betrieblichem Unterricht und außerbetrieblichen Schulungsveranstaltungen',
                'text' => $this->PdfGenerator->prepareTextWithTitleAndText($fullReportData['ReportInstruction'], 'title', 'text')
            );
            $this->set('detail', $instruction);
            $pdf->writeHTML($this->render('reportExportTemplates/ihk/detailElement'), false);

            unset($instruction);


            // school
            // TODO

            $pdf->writeHTML($this->render('reportExportTemplates/ihk/detailFooter'), true);

        }

        // kick it out
        if(!isset($debug)) $pdf->Output('pdf.pdf', 'I');
    }

    private function __setExportTemplate() {}

    //edit

    //delete

}