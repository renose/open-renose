<?php
/*
 * add.ctp
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
    $this->Html->addCrumb('Berichte', 'display');
    $this->Html->addCrumb($this->request->data['Report']['year'], array('action' =>'display', $this->request->data['Report']['year']));
    $this->Html->addCrumb('Bericht erstellen', 'add');
?>

<h1><?php echo $title_for_layout; ?></h1>

<?php
    echo $this->Form->create('Report');
    
    echo $this->Form->input('date', array('label' => 'Datum'));
    
    echo $this->Form->input('year', array('label' => 'Jahr', 'type' => 'text'));
    echo $this->Form->input('week', array('label' => 'Woche'));
    echo $this->Form->input('number', array('label' => 'Nummer'));

    echo $this->Form->end('Bericht erstellen');
?>