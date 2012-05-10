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
            'Profil' => array('img' => 'icons/user.png', 'url' => '/users/profil'),
            'Einstellungen' => array('img' => 'icons/settings.png', 'url' => '/users/settings')
        ),
        'Dev' => array(
            'Welcome Page' => array('img' => 'icon/menu_item.png', 'url' => '/users/welcome'),
            'User Test Page' => array('img' => 'icon/menu_item.png', 'url' => '/users/test')
        ),
        'Seiten' => array(
            'Home' => array('img' => 'icons/home.png', 'url' => '/'),
            'Über das Projekt' => array('img' => 'icons/info.png', 'url' => '/page/about'),
            'FAQ' => array('img' => 'icons/help.png', 'url' => '/page/faq')
        ),
        'Berichte' => array(
            'Übersicht' => array('img' => 'icons/calendar.png', 'url' => '/reports/display'),
            'Hinzufügen' => array('img' => 'icons/add_list.png', 'url' => '/reports/add')
        )
    );
    
    foreach($nav as $title => $items)
    {
        echo '<div class="nav-section">';
        echo '<div class="nav-title">' . $title . '</div>';
        
        echo '<ul>';
        foreach($items as $name => $options)
        {
            echo '<a href="' . $this->Html->url($options['url']) . '">';
            
            if($this->Html->url(null) == $this->Html->url($options['url']))
                echo '<li class="active">';
            else
                echo '<li>';
            
            echo $this->Html->image($options['img']);
            echo $name;
            echo '</li>';
            
            echo '</a>';
        }
        echo '</ul>';
        
        echo '</div>';
    }
?>