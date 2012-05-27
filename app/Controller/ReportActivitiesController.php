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

class ReportActivitiesController extends AppController
{
    
    public $components = array('Json');
    
    public function beforeFilter()
    {
        parent::beforeFilter();
        
        if($this->action == 'save' || $this->action == 'delete')
        {
            $this->Security->csrfCheck = false;
            $this->Security->validatePost = false;
        }
    }

    public function save()
    {
        if(!isset($this->request->data['report_id']))
            $this->Json->error('Fehler beim Speichern der Tätigkeit.', -20, $this->request->data);
        
        $this->loadModel('Report');
        $report = $this->Report->findByIdAndUserId($this->request->data['report_id'], $this->Auth->user('id'));
        
        if(isset($report['ReportActivity']['id']))
        {
            $report['ReportActivity']['text'] = $this->request->data['value'];
            
            if($this->ReportActivity->save($report))
            {
                $this->data = $this->ReportActivity->findById($report['ReportActivity']['id']);
                $this->Json->response($this->data['ReportActivity']['text'], 11);
            }
            else
                $this->Json->error('Fehler beim Speichern der Tätigkeit.', -11, $this->request->data);
        }
        else
        {
            $report = array(
                'ReportActivity' => array(
                    'report_id' => $report['Report']['id'],
                    'text' => $this->request->data['value']
                )
            );
            
            $this->ReportActivity->create();
            if($this->ReportActivity->save($report))
            {
                $this->data = $this->ReportActivity->findById($this->ReportActivity->getLastInsertId());
                $this->Json->response($this->data['ReportActivity']['text'], 12);
            }
            else
                $this->Json->error('Fehler beim Speichern der Tätigkeit.', -12, $this->request->data);
        }
    }
}