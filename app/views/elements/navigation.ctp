<?php
    $menulinks = $this->requestAction('/menu_links/main');
    
    foreach($menulinks as $menulink)
    {
        echo '<li>';
        echo $this->Html->link($menulink['MenuLink']['title'], $menulink['MenuLink']['link']);
        echo '</li>';
    }
?>