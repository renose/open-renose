<?php
/*
 * profiles_controller.php
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

class ProfilesController extends AppController
{

    public function beforeFilter()
    {
        parent::beforeFilter();
    }

    public function index()
    {
        $this->loadModel('Job');
        $profile = $this->Profile->findByUserId($this->Auth->user('id'));
        $jobs = $this->Job->find('all', array('recursive' => 0));
        $this->set('title_for_layout', 'Profil');

        $job_list = array();
        foreach($jobs as $job)
            $job_list[] = $job['Job']['name'];

        //Daten eingegeben? => Speichern
        if (!empty($this->request->data))
        {
            $job_name = $this->request->data['Profile']['job_name'];
            $job = $this->Job->findByName($job_name);

            if($job != null)
                $this->request->data['Profile']['job_id'] = $job['Job']['id'];
            else
                $this->request->data['Job']['name'] = $job_name;

            if ($this->Profile->saveAssociated($this->request->data))
            {
                $this->Session->setFlash('Dein Profil wurde gespeichert.', 'flash_success');
                $this->redirect( array('controller' => 'users', 'action' => 'dashboard') );
            }
            else
                $this->Session->setFlash('Fehler beim Speichern des Profils.');
        }
        else
        {
            $profile['Profile']['job_name'] = $profile['Job']['name'];
            $this->request->data = $profile;
        }

        $this->set('jobs', $job_list);
    }
}