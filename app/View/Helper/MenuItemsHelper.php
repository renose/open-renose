<?php

/*
 * menu_items.php
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

class MenuItemsHelper extends Helper
{

    public $helpers = Array('Html');

    function show($data)
    {
        echo '<ul>';

        foreach($data as $menuitem)
        {
            echo '<li>';

            if($menuitem['MenuItem']['link'])
                echo $this->Html->link($menuitem['MenuItem']['title'], $menuitem['MenuItem']['link']);
            else
                echo $menuitem['MenuItem']['title'];

            if($menuitem['children'])
                $this->show($menuitem['children']);

            echo '</li>';
        }

        echo '</ul>';
    }

}
?>