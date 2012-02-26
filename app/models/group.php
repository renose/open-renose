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
?>

<?php

class Group extends AppModel
{
    var $name = 'Group';
    var $displayField = 'description';
    
    var $validate = array(
        'name' => array(
            'mustBeSet' => array(
                'rule' => array('notEmpty'),
                'message' => 'Bitte geben Sie einen Namen ein.',
                'last' => true),
            'mustUnique' => array(
                'rule' => 'isUnique',
                'message' => 'Dieser Name wird bereits verwendet.')),
        'description' => array(
            'mustBeSet' => array(
                'rule' => array('notEmpty'),
                'message' => 'Bitte geben Sie eine Beschreibung ein.',
                'last' => true)));

    var $hasMany = array('GroupPermission');
    var $hasAndBelongsToMany = array('User');
}
?>