<?php
/*
 * navigation.ctp
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

<div class="nav-section">
    <div class="nav-title">Main</div>
    <ul>
        <li class="active">
            <?php echo $this->Html->image('icon/dashboard.png'); ?>
            <?php echo $this->Html->link('Dashboard', '/'); ?>
        </li>
        <li>
            <?php echo $this->Html->image('icon/menu_item.png'); ?>
            <?php echo $this->Html->link('Test Page', '/users/test'); ?>
        </li>
    </ul>
</div>

<div class="nav-section">
    <div class="nav-title">Berichte</div>
    <ul>
        <li>
            <?php echo $this->Html->image('icon/menu_item.png'); ?>
            <?php echo $this->Html->link('Übersicht', '/reports'); ?>
        </li>
        <li>
            <?php echo $this->Html->image('icon/menu_item.png'); ?>
            <?php echo $this->Html->link('Hinzufügen', '/reports/add'); ?>
        </li>
        <li>
            <?php echo $this->Html->image('icon/menu_item.png'); ?>
            Exportieren
        </li>
    </ul>
</div>

<div class="nav-section">
    <div class="nav-title">Klasse</div>
    <ul>
        <li>
            <?php echo $this->Html->image('icon/menu_item.png'); ?>
            bla
        </li>
        <li>
            <?php echo $this->Html->image('icon/menu_item.png'); ?>
            bla
        </li>
        <li>
            <?php echo $this->Html->image('icon/menu_item.png'); ?>
            bla
        </li>
    </ul>
</div>