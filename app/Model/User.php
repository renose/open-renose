<?php

/*
 * user.php
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

class User extends AppModel
{

    public $displayField = 'email';
    public $validate = array(
        'email' => array(
            'mustBeEmail' => array(
                'rule' => array('email', true),
                'message' => 'Bitte geben Sie eine gültige Email ein.',
                'last' => true),
            'mustUnique' => array(
                'rule' => 'isUnique',
                'message' => 'Diese Email ist bereits registriert.')
        ),
        'password' => array(
            'mustBeLonger' => array(
                'rule' => array('minLength', 6),
                'message' => 'Ihr Passwort muss aus Sicherheitsgründen mindestens 6 Zeichen lang sein.',
            )
        ),
        'password_confirm' => array(
            'equals' => array(
                'rule' => array('equalToField', array(
                    'this_field' => 'password_confirm',
                    'other_field' => 'password'
                    )
                ),
                'message' => 'Bitte geben Sie ihr Passwort zur Bestätigung nochmals korrekt ein.'
            )
        )
    );
    public $hasOne = array(
        'Profile' => array(
            'dependent' => true
        ),
        'Schedule' => array(
            'dependent' => true
        )
    );
    public $hasMany = array('CalendarEntry');

    function equalToField($data, $options)
    {
        return $data[$options['this_field']] == $this->data[$this->alias][$options['other_field']];
    }

}
