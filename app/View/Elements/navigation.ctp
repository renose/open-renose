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
            'Dashboard' => array('img' => 'icon/dashboard.png', 'url' => '/')
        ),
        'Dev' => array(
            'Groups' => array('img' => 'icon/menu_item.png', 'url' => '/groups/display'),
            'Welcome Page' => array('img' => 'icon/menu_item.png', 'url' => '/users/welcome'),
            'User Test Page' => array('img' => 'icon/menu_item.png', 'url' => '/users/test')
        ),
        'Seiten' => array(
            'Home' => array('img' => 'icon/menu_item.png', 'url' => '/'),
            'Über das Projekt' => array('img' => 'icon/menu_item.png', 'url' => '/page/about'),
            'FAQ' => array('img' => 'icon/menu_item.png', 'url' => '/page/faq')
        ),
        'Berichte' => array(
            'Übersicht' => array('img' => 'icon/menu_item.png', 'url' => '/reports/display'),
            'Hinzufügen' => array('img' => 'icon/menu_item.png', 'url' => '/page/about')
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