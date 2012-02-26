<?php

/*
 * view.ctp
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
    $html->addCrumb('Berichte', array('action' => 'display', $report['Report']['year']));
    $html->addCrumb('Bericht ' . $report['Report']['number']);
?>

<h1><?php echo $title_for_layout; ?></h1>

<b>Tätigkeiten</b>
<hr/><div>
<?php
    foreach ($report['ReportActivities'] as $reportActivity)
    {
        printf('<i>%2u:%02uh</i> ', $reportActivity['duration'] / 60, $reportActivity['duration'] % 60);
        echo $reportActivity['text'];
        
        echo $html->link(
                $this->Html->image("icon/edit.png", array("alt" => "Tätigkeit bearbeiten", "align" => "center")),
                array('controller' => 'report_activities', 'action' => 'edit', $reportActivity['id']), array('escape' => false) );
        
        echo ' ';
        
        echo $html->link(
                $this->Html->image("icon/delete.png", array("alt" => "Tätigkeit löschen", "align" => "center")),
                array('controller' => 'report_activities', 'action' => 'delete', $reportActivity['id']), array('escape' => false),
                'Wollen Sie diese Tätigkeit wirklich löschen?');
        
        echo '<br/>';
    }
?>
</div>
<?php
    echo $html->link(
            $this->Html->image("icon/add.png", array("alt" => "Tätigkeit hinzufügen", "align" => "center", "id" => "ico-addpage")),
            array('controller' => 'report_activities', 'action' => 'add', $report['Report']['id']),
            array('escape' => false));
?>

<hr/>
<br/>
<br/>

<b>Unterweisungen</b>
<hr/><div>
<?php
    foreach ($report['ReportInstructions'] as $reportInstruction)
    {
        echo '<i>' . $reportInstruction['title'] . '</i> ';
        
        echo $html->link(
                $this->Html->image("icon/edit.png", array("alt" => "Unterweisung bearbeiten", "align" => "center")),
                array('controller' => 'report_instructions', 'action' => 'edit', $reportInstruction['id']), array('escape' => false) );
        
        echo ' ';
        
        echo $html->link(
                $this->Html->image("icon/delete.png", array("alt" => "Unterweisung löschen", "align" => "center")),
                array('controller' => 'report_instructions', 'action' => 'delete', $reportInstruction['id']), array('escape' => false),
                'Wollen Sie diese Unterweisung wirklich löschen?');
        
        echo '<dir>' . $reportInstruction['text'] . '</dir>';
        
        echo '<br/>';
    }
?>
</div>
<?php
    echo $html->link(
            $this->Html->image("icon/add.png", array("alt" => "Unterweisung hinzufügen", "align" => "center", "id" => "ico-addpage")),
            array('controller' => 'report_instructions', 'action' => 'add', $report['Report']['id']),
            array('escape' => false));
?>
<hr/>

<?php
    pr($report);
?>