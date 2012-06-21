<?php
    $nav = array(
        'Seiten' => array(
            'Home' => array('img' => 'icons_white/home.png', 'url' => '/'),
            //'Über das Projekt' => array('img' => 'icons_white/info.png', 'url' => '/page/about'),
            //'FAQ' => array('img' => 'icons_white/help.png', 'url' => '/page/faq'),
            'Registrieren' => array('img' => 'icons_white/key.png', 'url' => '/users/register')
        )
    );
    
    $this->Navigation->frontpage($nav, array('list-class' => 'nav', 'section' => false, 'title' => false));
?>