<?php

    class MenusController extends AppController
    {
        var $name = 'Menus';

        function get_items($menu)
        {
            $menu = $this->Menu->find('first', array(
                'conditions' => array('Menu.title' => $menu)));

            if (!empty($this->params['requested']))
            {
                return $menu;
            }
            else
            {
                $this->set(compact('menuitems'));
            }
        }
    }

?>