<?php

/*
 * profile.php
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

class Profile extends AppModel
{

        public $virtualFields = array(
            'full_name' => "CONCAT(Profile.first_name, ' ', Profile.last_name)"
        );

        public $belongsTo = array('User', 'Job');

    public $displayField = 'full_name';

    public function afterSave($created)
    {
        parent::afterSave($created);

        $this->Job->query('delete from jobs where (select count(*) from profiles Profile where Profile.job_id = jobs.id) = 0');
    }

}