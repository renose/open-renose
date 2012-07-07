<?php

/*
 * NavigationHelper.php
 *
 * Copyright (c) 2011-2012 open reNose team <info at renose.de>.
 * Simon Wörner, Patrick Hafner and Daniel Greiner.
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

class NavigationHelper extends Helper {

    public $helpers = array('Html');

    public function show($navigation)
    {
        foreach($navigation as $title => $items)
        {
            echo '<div class="nav-section">';
            echo '<div class="nav-title">' . $title . '</div>';

            echo '<ul>';
            foreach($items as $name => $options)
            {
                echo '<a href="' . $this->Html->url($options['url']) . '">';

                if(strpos($this->Html->url(null), $this->Html->url($options['url'])) === 0)
                    echo '<li class="active">';
                else
                    echo '<li>';

                if(isset($options['img']))
                    echo $this->Html->image($options['img']);
                echo $name;

                echo '</li>';

                echo '</a>';
            }
            echo '</ul>';

            echo '</div>';
        }
    }

    public function frontpage($navigation)
    {
        foreach($navigation as $title => $items)
        {
            echo '<ul class=nav>';
            foreach($items as $name => $options)
            {
                if($this->Html->url(null) == $this->Html->url($options['url']))
                    echo '<li class="active">';
                else
                    echo '<li>';

                echo '<a href="' . $this->Html->url($options['url']) . '">';

                if(isset($options['img']))
                    echo $this->Html->image($options['img']);
                echo $name;

                echo '</a>';

                echo '</li>';
            }
            echo '</ul>';
        }
    }

}