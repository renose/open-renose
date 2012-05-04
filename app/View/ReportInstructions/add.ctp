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
    $this->Html->addCrumb('Berichte', array('action' => 'display', $report['Report']['year']));
    $this->Html->addCrumb('Bericht ' . $report['Report']['number'], array('controller' => 'reports', 'action' => 'view', $report['Report']['year'], $report['Report']['week']));
    $this->Html->addCrumb('Unterweisung');
    $this->Html->addCrumb('Add');
?>

<h1><?php echo $title_for_layout; ?></h1>

<?php    
    echo $this->Form->create('ReportInstruction');
    
    echo $this->Form->input('Report.id');
    echo $this->Form->input('title', array('label' => 'Unterweisung'));
    echo $this->Form->input('text', array('label' => 'Unterweisungs Inhalt'));

    echo $this->Form->end('Unterweisung hinzufügen');
    
    pr($this->request->data);
?>