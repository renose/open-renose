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

<h1 class="frontpage-headline">
    <?php echo $this->Html->image('icons/key.png'); ?>
    Registrieren
</h1>

<?php
    echo $this->Form->create('User', array(
	'action' => 'register',
	'inputDefaults' => array(
	    'div' => 'control-group',
	    'error' => array('attributes' => array('wrap' => 'span', 'class' => 'help-inline'))
	    )
	));

    echo $this->Form->input('email');

    echo $this->Form->input('password', array('label' => 'Passwort'));
    echo $this->Form->input('password_confirm', array('required' => true, 'type' => 'password', 'label' => 'Passwort bestätigen'));

    /*echo $ajax->submit('Submit',
            array(
                'url'=> array('controller'=>'users', 'action'=>'register'),
                'update' => 'testdiv'));
    echo $this->Form->end();*/
    echo $this->Form->end('Registrieren');
?>