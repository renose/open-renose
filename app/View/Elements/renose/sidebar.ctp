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

<?php
    $nav = array(
        'Main' => array(
            'Dashboard' => array('img' => 'icons/clipboard.png', 'url' => '/dashboard'),
            'Profil' => array('img' => 'icons/user.png', 'url' => '/profiles'),
            'Einstellungen' => array('img' => 'icons/settings.png', 'url' => '/users/settings')
        ),
        'Dev' => array(
            'Welcome Page' => array('img' => 'icon/menu_item.png', 'url' => '/users/welcome'),
            'User Test Page' => array('img' => 'icon/menu_item.png', 'url' => '/users/test')
        ),
        'Seiten' => array(
            'Über das Projekt' => array('img' => 'icons/info.png', 'url' => '/page/about'),
            'FAQ' => array('img' => 'icons/help.png', 'url' => '/page/faq')
        ),
        'Berichte' => array(
            'Übersicht' => array('img' => 'icons/calendar.png', 'url' => '/reports/display'),
            'Hinzufügen' => array('img' => 'icons/add_list.png', 'url' => '/reports/add')
        )
    );
    
    $this->Navigation->show($nav);
?>