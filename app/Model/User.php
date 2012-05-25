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
                'rule' => array('minLength', 5),
                'message' => 'Ihr Passwort muss aus Sicherheitsgründen mindestens 5 Zeichen lang sein.',
            ),
            'equals' => array(
                'rule' => array('passwordCheck', 'password_confirm'),
                'message' => ''
            )
        ),
        'password_confirm' => array(
            'mustBeLonger' => array(
                'rule' => array('minLength', 5),
                'message' => 'Ihr Passwort muss aus Sicherheitsgründen mindestens 5 Zeichen lang sein.'
            ),
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
    public $hasMany = array('CalenderEntry');

    function passwordCheck($data, $field) {

        // $data['password'] = password value
        // $field = field which has to be equal
        if($data['password'] != $this->data[$this->alias][$field]) {
            $this->invalidate($field, 'Bitte geben Sie ihr Passwort zur Bestätigung nochmals korrekt ein');
            return false;
        } else {
            return true;
        }

        /*$password = $this->data[$this->name][$field];
        $password_confirm = $check['password_confirm'];
        $password_confirm = Security::hash(Configure::read('Security.salt') . $password_confirm);

        return $password == $password_confirm;*/
    }

}
