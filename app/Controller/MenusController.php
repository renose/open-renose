<?php

/*
 * menus_controller.php
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

class MenusController extends AppController
{
    public $scaffold;

    public function beforeFilter()
    {
        //parent::beforeFilter();
        $this->Auth->allow('*');
    }

    function get_items($menu)
    {
        $this->autoRender = false;

        $menu = $this->Menu->findByTitle($menu);
        $menu_items = $this->Menu->MenuItem->find('threaded', array(
                    'order' => 'MenuItem.position ASC',
                    'conditions' => array(
                        'MenuItem.menu_id = ' => $menu['Menu']['id'])
            ));

        if (!empty($this->request->params['requested']))
            return $menu_items;
    }
}

?>