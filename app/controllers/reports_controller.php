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
?>

<?php

class ReportsController extends AppController
{

    public $name = 'Reports';
    public $scaffold;

    public function beforeFilter()
    {
        //parent::beforeFilter();
        $this->Auth->allow('*');
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
                'User.id = ' . $this->Auth->user('id'),
                "Report.year = $year")
        )));
    }
    
    public function view($year, $week)
    {
        $report =
            $this->Report->find('first', array(
                'conditions' => array(
                    'User.id = ' . $this->Auth->user('id'),
                    "Report.year = $year",
                    "Report.week = $week")
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

        if (!empty($this->data))
        {
            $this->data['Report']['user_id'] = $this->Auth->user('id');
            
            if ($this->Report->save($this->data))
            {
                $this->Session->setFlash('Ihr Bericht wurde erstellt.', 'flash_success');
                $this->redirect( array('action' => 'view', $year, $week) );
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
                    'conditions' => array('User.id = ' . $this->Auth->user('id'))
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
            $this->data['Report']['year'] = $year;
            $this->data['Report']['week'] = $week;
            $this->data['Report']['number'] = $number;
        }
    }
    
    //edit
    
    //delete
    
}
?>