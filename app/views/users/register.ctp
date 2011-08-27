<?php
/* 
 * register.ctp
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

<h1>Registrieren</h1>

<div id="testdiv"></div>

<?php
    echo $form->create('User', array('action' => 'register'));

    echo $form->input('email');

    echo $form->input('password', array('label' => 'Passwort'));
    echo $form->input('password_confirm', array('required' => true, 'type' => 'password', 'label' => 'Passwort bestätigen'));

    /*echo $ajax->submit('Submit',
            array(
                'url'=> array('controller'=>'users', 'action'=>'register'),
                'update' => 'testdiv'));
    echo $form->end();*/
    echo $form->end('Registrieren');
?>