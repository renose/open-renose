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
    //public $schoolStartMonth = '9';
    public $scaffold;

    public function beforeFilter()
    {
        //parent::beforeFilter();
        $this->Auth->allow('*');
    }
    
    public function display($year = null)
    {
        $this->set('title_for_layout', 'Berichte Verwalten');
        
        //Kein Schuljahr übergeben => dieses Schuljahr nehmen
        if(!$year)
        {
            //Aktuelles Datum nach Schulbegin? Wenn ja, dann ist dieses Jahr das erste des Schuljahrs
            if(mktime(0, 0, 0, date('m'), date('d')) > mktime(0, 0, 0, $this->schoolStartMonth, 1))
                $year = date('Y');
            //Wenn nein, dann war letztes Jahr das erste des Schuljahrs
            else
                $year = date('Y') - 1;
        }
        
        //Wochen anzahl berechnen
        $weeks = 54;
        $firstDay = mktime(0,0,0, $this->schoolStartMonth, 1, $year);
        $lastDay = mktime(0,0,0, $this->schoolStartMonth, 0, $year + 1);     
        pr(date('W', $firstDay));
        pr(date('W', $lastDay));
        pr(date('W', $lastDay - $firstDay));
        
        pr(date('d.m.Y l', $firstDay));
        pr(date('d.m.Y l', $lastDay));
        pr(date('d.m.Y l', $lastDay - $firstDay));
        
        $this->set('firstDay', $firstDay);
        $this->set('lastDay', $lastDay);
        
        $this->set('year', $year);
        $this->set('weeks', $weeks);
        $this->set('reports', $this->Report->find('all', array(
            'order' => 'Report.number ASC',
            'conditions' => array(
                'User.id = ' . $this->Auth->user('id'),
                "Report.year = $year")
        )));
    }
    
    public function view($year, $week)
    {
        $this->set('report', $this->Report->find('first', array(
            'conditions' => array(
                'User.id = ' . $this->Auth->user('id'),
                "Report.year = $year",
                "Report.number = $week")
        )));
    }
    
}
?>