<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <?php echo $this->Html->charset(); ?>
        <title><?= $title_for_layout.' - open reNose'; ?></title>
        <?php
        echo $this->Html->meta('icon');

        echo $this->Html->css(array(
            'renose',
            'calender',
            'cake.generic',
            'ui-lightness/jquery-ui-1.8.16.custom',
            'http://fonts.googleapis.com/css?family=Open+Sans',
        ));

        echo $this->Html->script(array(
            'jquery-1.6.4.min',
            'jquery-ui-1.8.16.custom.min',
            'ckeditor/ckeditor'
        ));

        echo $scripts_for_layout;
        ?>
    </head>
    <body>
        <header>
            <a href="<?php echo $this->Html->url('/', true); ?>">
                <h1 id="logo">
                    <span>open</span>reNose
                </h1>
            </a>
            <div id="headerinfo">
                <?php echo $this->element('userinfo'); ?>
            </div>
        </header>

        <nav>
            <?php echo $this->element('navigation', array('menu' => 'main', 'cache' => '+3 hour')); ?>
        </nav>

        <div id="content">
            <p class="breadcrumb">
                <?php echo $this->Html->getCrumbs(' > ', 'Home'); ?>
            </p>
            <?php
            echo $this->Session->flash();
            echo $this->Session->flash('auth');
            echo $this->Session->flash('email');
            ?>

            <?php echo $content_for_layout; ?>

            <?php echo $this->element('sql_dump'); ?>
        </div>

        <footer>
            <p>Page rendered in <?php echo round((microtime(true) - $_SERVER['REQUEST_TIME']) * 1000) ?>ms</p>

            <p>
                (c) 2011-2012 by
                <a href="mailto:simon@renose.de">Simon Wörner</a>, 
                <a href="mailto:patrick@renose.de">Patrick Hafner</a> and
                <a href="mailto:patrick@renose.de">Daniel Greiner</a> |
                <a href="http://www.renose.de">renose.de</a></p>
            </div>
        </footer>
        <?php echo $this->Js->writeBuffer(); ?>
    </body>
</html>