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
    public function export() {
        // load user model for data
        $this->loadModel('User');
        // create view for using elements in controller
        #$view = new View($this, false);

        $userProfile = $this->User->Profile->findByUserId($this->Auth->user('id'));

        $reports = $this->Report->find('all', array(
                'conditions' => array(
                    'User.id = ' => $this->Auth->user('id'),
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
        $pdf->writeHTML($this->render('reportExportTemplates/ihk/overview'), true);

        // the whole activity list
        $activityList = array();


        // dummy records - yet!
        $activityDummyRecord = array(
            'abteilung' => 'Softwareentwicklung',
            'von' => '01.09.2010',
            'bis' => '03.09.2010',
        );

        for($i=0;$i<1;$i++) {
            $activityList[] = $activityDummyRecord;
        }

        $this->set('activityList', $activityList);
        $sizeOfActivityList = sizeof($activityList);

        // max 31 records per page (A4)
        $pageCounter = ceil($sizeOfActivityList / 31);


        // fresh rendering for every page
        for($i=0;$i<$pageCounter;$i++) {
            $pdf->AddPage();

            $this->set('start', $i*31);
            $this->set('end', ($i+1)* 31);

            $pdf->writeHTML($this->render('reportExportTemplates/ihk/activityList'), true);
        }

        // generate detailed week view

        // dummy records, yet!
        #$text = 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi. Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi.Nam liber tempor cum soluta nobis eleifend option congue nihil imperdiet doming id quod mazim placerat facer.Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi. Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi.Nam liber tempor cum soluta nobis eleifend option congue nihil imperdiet doming id quod mazim placerat facer.Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi. Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi.Nam liber tempor cum soluta nobis eleifend option congue nihil imperdiet doming id quod mazim placerat facer.Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut';
$text = 'Die Stimmung in der deutschen Wirtschaft hat im Mai einen Dämpfer bekommen. Der ifo-Geschäftsklimaindex fiel von 109,9 auf 106,9 Punkte, wie das Ifo-Institut in München mitteilte. Die befragten Unternehmen beurteilten sowohl ihre aktuelle Geschäftslage aus auch ihre Aussichten für das nächste halbe Jahr weit ungünstiger. "Die deutsche Wirtschaft steht unter dem Eindruck der in letzter Zeit gestiegenen Unsicherheit im Euro-Raum", erklärte Ifo-Präsident Hans-Werner Sinn.

Trotz der Euro-Schuldenkrise und der Rezession in Südeuropa war das wichtigste Stimmungsbarometer der deutschen Wirtschaft seit November stetig geklettert. Jetzt erfolgte eine massive Korrektur. Die Industriefirmen beurteilen ihre aktuelle Geschäftslage deutlich schlechter als noch im April. Bei der Bewertung der Geschäftsaussichten hielten sich positive und negative Erwartungen die Waage.

Vorsichtigere Personalplanung setzt ein

Das schlägt sich auch bei der Personalplanung nieder: "Die Beschäftigtenpläne sind erstmals seit Monaten mehrheitlich defensiv ausgerichtet", sagte Sinn. Für den Export würden allerdings weitere Impulse erwartet.

Im Einzelhandel ist die Lageeinschätzung eingebrochen, und die Erwartungen sind wieder mehrheitlich pessimistisch. Auch auf dem Bau sank der Index – die Baubetriebe blicken weniger optimistisch auf die kommende Entwicklung.';
        $dummyDetail = array(
            'number' => '01',
            'section' => 'Softwareentwicklung', // Abteilung
            'from' => '01.09.2010',
            'to' => '03.09.2010',
            'date' => '06.09.2010',
            'detail' => array(
                array(
                    'title' => 'Betriebliche Tätigkeit',
                    'text' => $text
                ),
                array(
                    'title' => 'Themen von Unterweisungen, Lehrgesprächen, betrieblichem Unterricht und außerbetrieblichen Schulungsveranstaltungen',
                    'text' => $text
                ),
                array(
                    'title' => 'Berufsschule (Themen des Unterrichts in den einzelnen Fächern)',
                    'text' => $text
                )
            )
        );

        $dummyData = array($dummyDetail, $dummyDetail);

        foreach($dummyData as $data) {
            $pdf->AddPage();


            /*
             *  /*$length = 3780;
                if (strlen($text) > $length) {
                    $text = substr($text, 0, strpos(wordwrap($text, $length), "\n")).' ...';
                }
                echo $text;
             */

            // write first header
            $pdf->writeHTML($this->render('reportExportTemplates/ihk/detailHeader'), true);


            // loop though detail data
            $sizeOfDetailData = sizeof($data['detail']);
            $loopCounter = 0;
            foreach($data['detail'] as $detail) {
                $loopCounter++;
                $length = 3670;
                $pagebreak = false;
                if (strlen($detail['text']) > $length) {
                    $detail['text'] = substr($detail['text'], 0, strpos(wordwrap($detail['text'], $length), "\n")).' ...';
                    $pagebreak = true;
                }

                $this->set('detail', $detail);
                $pdf->writeHTML($this->render('reportExportTemplates/ihk/detailElement'), false);

                if($pagebreak) {
                    $pdf->writeHTML($this->render('reportExportTemplates/ihk/detailFooter'), true);
                    if($loopCounter != $sizeOfDetailData) {
                        $pdf->AddPage();
                        $pdf->writeHTML($this->render('reportExportTemplates/ihk/detailHeader'), true);
                    }
                }
            }

            if(!$pagebreak) {
                $pdf->writeHTML($this->render('reportExportTemplates/ihk/detailFooter'), true);
            }

        }

        #$pdf->writeHTML($this->render('reportExportTemplates/ihk/detail'), true);
        // kick it out
        $pdf->Output('pdf.pdf', 'I');
    }

    private function __setExportTemplate() {}

    //edit

    //delete

}