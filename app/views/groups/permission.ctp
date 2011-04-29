<?php
/* 
 * permission.ctp
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

<td><?php echo $action; ?></td>

<td>
    <?php
        switch($do)
        {
            case 'allow':
                echo $this->Html->image("icon/accept.png", array("alt" => "Erlaubt", "align" => "center"));
                break;

            case 'deny':
                echo $this->Html->image("icon/cancel.png", array("alt" => "Verboten", "align" => "center"));
                break;

            default:
                echo '[permission not found] ';
            case 'remove':
                echo $this->Html->image("icon/page_white.png", array("alt" => "Nicht gesetzt", "align" => "center"));
                break;
        }
    ?>
</td>

<td>
    <?php
        switch($do)
        {
            case 'allow':
                echo $ajax->link(
                    $this->Html->image("icon/cancel.png", array("alt" => "Seite editieren", "align" => "center")),
                    array('action' => 'permission', 'deny', $group['Group']['name'], $controller, $action),
                    array('update' => "$controller.$action", 'escape' => false) );
                echo ' ';
                echo $ajax->link(
                    $this->Html->image("icon/delete.png", array("alt" => "Seite editieren", "align" => "center")),
                    array('action' => 'permission', 'remove', $group['Group']['name'], $controller, $action),
                    array('update' => "$controller.$action", 'escape' => false) );
                break;

            case 'deny':
                echo $ajax->link(
                    $this->Html->image("icon/accept.png", array("alt" => "Seite editieren", "align" => "center")),
                    array('action' => 'permission', 'allow', $group['Group']['name'], $controller, $action),
                    array('update' => "$controller.$action", 'escape' => false) );
                echo ' ';
                echo $ajax->link(
                    $this->Html->image("icon/delete.png", array("alt" => "Seite editieren", "align" => "center")),
                    array('action' => 'permission', 'remove', $group['Group']['name'], $controller, $action),
                    array('update' => "$controller.$action", 'escape' => false) );
                break;

            default:
                echo '[permission not found] ';
            case 'remove':
                echo $ajax->link(
                    $this->Html->image("icon/accept.png", array("alt" => "Seite editieren", "align" => "center")),
                    array('action' => 'permission', 'allow', $group['Group']['name'], $controller, $action),
                    array('update' => "$controller.$action", 'escape' => false) );
                echo ' ';
                echo $ajax->link(
                    $this->Html->image("icon/cancel.png", array("alt" => "Seite editieren", "align" => "center")),
                    array('action' => 'permission', 'deny', $group['Group']['name'], $controller, $action),
                    array('update' => "$controller.$action", 'escape' => false) );
                break;
        }
    ?>
</td>