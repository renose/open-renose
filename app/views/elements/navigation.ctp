<?php
    $menu = $this->requestAction("/menus/get_items/$menu");
    
    foreach($menu['MenuItem'] as $menuitem)
    {
        echo '<li>';
        echo $this->Html->link($menuitem['title'], $menuitem['link']);
        echo '</li>';
    }
?>