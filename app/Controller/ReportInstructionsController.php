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

class ReportInstructionsController extends AppController
{
    public $components = array('Json');

    public function beforeFilter()
    {
        parent::beforeFilter();
        
        if($this->action == 'save' || $this->action == 'delete')
        {
            $this->Security->csrfCheck = false;
            $this->Security->validatePost = false;
            Configure::write('Error.handler', 'JsonError::handleError');
            Configure::write('Exception.handler', 'JsonError::handleException');
        }
    }

    public function save()
    {
        if(!isset($this->request->data['report_id']))
            $this->Json->error('Fehler beim Speichern der Tätigkeit.', -20, $this->request->data);
        
        $this->loadModel('Report');
        $report = $this->Report->findByIdAndUserId($this->request->data['report_id'], $this->Auth->user('id'));
        
        if(isset($report['ReportInstruction']['id']))
        {
            $report['ReportInstruction']['text'] = $this->request->data['value'];
            
            if($this->ReportInstruction->save($report))
            {
                $this->data = $this->ReportInstruction->findById($report['ReportActivity']['id']);
                $this->Json->response($this->data['ReportInstruction']['text'], 11);
            }
            else
                $this->Json->error('Fehler beim Speichern der Tätigkeit.', -11, $this->request->data);
        }
        else
        {
            $report = array(
                'ReportInstruction' => array(
                    'report_id' => $report['Report']['id'],
                    'text' => $this->request->data['value']
                )
            );
            
            $this->ReportInstruction->create();
            if($this->ReportInstruction->save($report))
            {
                $this->data = $this->ReportInstruction->findById($this->ReportInstruction->getLastInsertId());
                $this->Json->response($this->data['ReportInstruction']['text'], 12);
            }
            else
                $this->Json->error('Fehler beim Speichern der Tätigkeit.', -12, $this->request->data);
        }
    }
}