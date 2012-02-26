<?php
/* 
 * report_instructions_controller.php
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

class ReportInstructionsController extends AppController
{
    public $scaffold;

    public function beforeFilter()
    {
        //parent::beforeFilter();
        $this->Auth->allow('*');
    }
    
    function add($report_id = null)
    {
        $this->set('title_for_layout', 'Unterweisung hinzufügen');
        
        //Bericht Id aus Formular übernehmen
        if(!empty($this->request->data['Report']['id']))
            $report_id = $report_id = $this->request->data['Report']['id'];
        
        //Bericht laden
        if($report_id)
        {
            $report = $this->ReportInstruction->Report->find('first', array(
                        'order' => 'Report.number ASC',
                        'conditions' => array('User.id = ' => $this->Auth->user('id'), 'Report.id = ' => $report_id)));
        }
        
        //Daten eingegeben? => Speichern
        if (!empty($this->request->data))
        {
            if ($this->ReportInstruction->saveAll($this->request->data))
            {
                $this->Session->setFlash('Die Unterweisung wurde hinzugefügt.', 'flash_success');
                $this->redirect( array('controller' => 'reports', 'action' => 'view', $report['Report']['year'], $report['Report']['week']) );
            }
            else
            {
                $this->Session->setFlash('Fehler beim Hinzufügen der Unterweisung.');
            }
        }
        
        //Bericht nicht gefunden / nicht von diesem User => Abbrechen
        if(!$report)
        {
            $this->Session->setFlash("Bericht mit ID '$report_id' nicht gefunden. Unterweisung hinzufügen abgebrochen.");
            $this->redirect( array('controller' => 'reports', 'action' => 'display') );
        }
        else
        {
            //Bericht setzen
            $this->request->data['Report']['id'] = $report['Report']['id'];
        }
        
        $this->set('report', $report);
    }
    
    function edit($id = null)
    {
        $this->set('title_for_layout', 'Unterweisung ändern');
        
        //Bericht Id aus Formular übernehmen
        if(!empty($this->request->data['ReportInstruction']['id']))
            $id = $this->request->data['ReportInstruction']['id'];
        
        //Bericht laden
        if($id)
            $report = $this->ReportInstruction->find('first', array('conditions' => array('ReportInstruction.id = ' => $id)));
        
        //Daten eingegeben? => Speichern
        if (!empty($this->request->data))
        {
            if ($this->ReportInstruction->saveAll($this->request->data))
            {
                $this->Session->setFlash('Die Unterweisung wurde hinzugefügt.', 'flash_success');
                $this->redirect( array('controller' => 'reports', 'action' => 'view', $report['Report']['year'], $report['Report']['week']) );
            }
            else
            {
                $this->Session->setFlash('Fehler beim Ändern der Unterweisung.');
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
                $this->request->data = $report;
        }
        else
        {
            $this->Session->setFlash('Unterweisung nicht gefunden.');
            $this->redirect( array('controller' => 'reports', 'action' => 'display') );
        }
        
        $this->set('report', $report);
    }
    
    function delete($id)
    {
        $this->set('title_for_layout', 'Unterweisung löschen');

        //Bericht laden
        $report = $this->ReportInstruction->find('first', array('conditions' => array('ReportInstruction.id = ' => $id)));
        
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
            $this->Session->setFlash('Unterweisung nicht gefunden.');
            $this->redirect( array('controller' => 'reports', 'action' => 'display') );
        }

        //Löschen und zum Bericht zurückkehren
        $this->ReportInstruction->delete($report['ReportInstruction']['id']);
        $this->Session->setFlash('Die Unterweisung wurde gelöscht.', 'flash_success');
        $this->redirect( array('controller' => 'reports', 'action' => 'view', $report['Report']['year'], $report['Report']['week']) );
    }
}

?>