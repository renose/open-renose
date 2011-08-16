<?php
/* 
 * report_activities_controller.php
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

class ReportActivitiesController extends AppController
{
    public $name = 'ReportActivities';

    public function beforeFilter()
    {
        //parent::beforeFilter();
        $this->Auth->allow('*');
    }
    
    //view (?)
    
    function add($report_id = null)
    {
        $this->set('title_for_layout', 'Tätigkeit hinzufügen');
        
        //Bericht Id aus Formular übernehmen
        if(!empty($this->data['Report']['id']))
            $report_id = $report_id = $this->data['Report']['id'];
        
        //Bericht laden
        if($report_id)
        {
            $report = $this->ReportActivity->Report->find('first', array(
                        'order' => 'Report.number ASC',
                        'conditions' => array('User.id = ' => $this->Auth->user('id'), 'Report.id = ' => $report_id)));
        }
        
        //Daten eingegeben? => Speichern
        if (!empty($this->data))
        {
            if ($this->ReportActivity->saveAll($this->data))
            {
                $this->Session->setFlash('Die Tätigkeit wurde hinzugefügt.', 'flash_success');
                $this->redirect( array('controller' => 'reports', 'action' => 'view', $report['Report']['year'], $report['Report']['week']) );
            }
            else
            {
                $this->Session->setFlash('Fehler beim Hinzufügen der Tätigkeit.');
            }
        }
        
        //Bericht nicht gefunden / nicht von diesem User => Abbrechen
        if(!$report)
        {
            $this->Session->setFlash("Bericht mit ID '$report_id' nicht gefunden. Tätigkeit hinzufügen abgebrochen.");
            $this->redirect( array('controller' => 'reports', 'action' => 'display') );
        }
        else
        {
            //Bericht setzen
            $this->data['Report']['id'] = $report['Report']['id'];
        }
        
        $this->set('report', $report);
    }
    
    function edit($id = null)
    {
        $this->set('title_for_layout', 'Tätigkeit ändern');
        
        //Bericht Id aus Formular übernehmen
        if(!empty($this->data['ReportActivity']['id']))
            $id = $this->data['ReportActivity']['id'];
        
        //Bericht laden
        if($id)
            $report = $this->ReportActivity->find('first', array('conditions' => array('ReportActivity.id = ' => $id)));
        
        //Daten eingegeben? => Speichern
        if (!empty($this->data))
        {
            if ($this->ReportActivity->saveAll($this->data))
            {
                $this->Session->setFlash('Die Tätigkeit wurde hinzugefügt.', 'flash_success');
                $this->redirect( array('controller' => 'reports', 'action' => 'view', $report['Report']['year'], $report['Report']['week']) );
            }
            else
            {
                $this->Session->setFlash('Fehler beim Ändern der Tätigkeit.');
            }
        }
        else if($report)
        {
            //Gehört dem User?
            if($report['Report']['user_id'] != $this->Auth->user('id'))
            {
                $this->Session->setFlash('Keine Berechtigung.');
                $this->redirect( array('controller' => 'reports', 'action' => 'display') );
            }
            else
                $this->data = $report;
        }
        else
        {
            $this->Session->setFlash('Tätigkeit nicht gefunden.');
            $this->redirect( array('controller' => 'reports', 'action' => 'display') );
        }
        
        $this->set('report', $report);
    }
    
    function delete($id)
    {
        $this->set('title_for_layout', 'Tätigkeit löschen');

        //Bericht laden
        $report = $this->ReportActivity->find('first', array('conditions' => array('ReportActivity.id = ' => $id)));
        
        //Bericht vorhanden
        if($report)
        {
            //Gehört dem User?
            if($report['Report']['user_id'] != $this->Auth->user('id'))
            {
                $this->Session->setFlash('Keine Berechtigung.');
                $this->redirect( array('controller' => 'reports', 'action' => 'display') );
            }
        }
        else
        {
            $this->Session->setFlash('Tätigkeit nicht gefunden.');
            $this->redirect( array('controller' => 'reports', 'action' => 'display') );
        }

        //Löschen und zum Bericht zurückkehren
        $this->ReportActivity->delete($report['ReportActivity']['id']);
        $this->Session->setFlash('Die Tätigkeit wurde gelöscht.', 'flash_success');
        $this->redirect( array('controller' => 'reports', 'action' => 'view', $report['Report']['year'], $report['Report']['week']) );
    }
}

?>