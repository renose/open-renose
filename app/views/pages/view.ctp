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
    $html->addCrumb('Pages', 'display');
    $html->addCrumb($page['Page']['description'], '/page/' . $page['Page']['title']);
?>

<p style="text-align: right">
<?php
    echo $ajax->link(
            $this->Html->image("icon/edit.png", array("alt" => "Seite editieren", "align" => "center")),
            array('action' => 'edit', $page['Page']['title']),
            array('update' => 'page-content', 'escape' => false) );

    echo " ";

    echo $html->link(
        $this->Html->image("icon/delete.png", array("alt" => "Seite löschen", "align" => "center")),
        array('action' => 'delete', $page['Page']['title']), array('escape' => false),
        'Wollen Sie die Seite <' . $page['Page']['description'] . '> wirklich löschen?');
?><br/>

<small>Erstellt: <i><?php echo $page['Page']['created']?></i></small><br/>
<small>Letzte Änderung: <i><?php echo $page['Page']['modified']?></i></small>
</p>

<div id="page-content">
    <h1><?php echo $title_for_layout; ?></h1>

    <p><?php echo $page['Page']['body']?></p>
</div>