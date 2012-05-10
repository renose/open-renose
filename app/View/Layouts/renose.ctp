<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <?php echo $this->Html->charset(); ?>
        <title><?= $title_for_layout.' - open reNose'; ?></title>
        <?php
        echo $this->Html->meta('icon');

        echo $this->Html->css(array(
            'ui-lightness/jquery-ui-1.8.16.custom',
            'http://fonts.googleapis.com/css?family=Open+Sans',
            'cake.generic',
            'renose/screen',
            'calender',
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
            <div id="logo">
                <a href="<?php echo $this->Html->url('/', true); ?>">
                    <span>open</span>reNose
                </a>
            </div>
            <div id="global-search">
                <form>
                    <input type="search" placeholder="Global suchen..." />
                    <input type="submit" value="" />
                </form>
            </div>
            <div id="headerinfo">
                <?php echo $this->element('userinfo'); ?>
            </div>
        </header>

        <nav id="sidebar">
            <?php echo $this->element('navigation'); ?>
        </nav>
        
        <nav id="breadcrumb">
            <?php echo $this->Html->getCrumbs(' > ', 'Home'); ?>
        </nav>
        <div id="content">            
            <a name="top"></a>
            <?php
            echo $this->Session->flash();
            echo $this->Session->flash('auth');
            echo $this->Session->flash('email');
            ?>
            
            <?php echo $content_for_layout; ?>

            <?php echo $this->element('sql_dump'); ?>
        </div>

        <footer>
            <?php if(Configure::read('debug') > 0): ?>
            <div id="footer-left">Page rendered in <?php echo round((microtime(true) - $_SERVER['REQUEST_TIME']) * 1000) ?>ms</div>
            <?php endif; ?>
            
            <div id="footer-right">
                <a class="icon-goto-top" href="#top">
                    <?php echo $this->Html->image('icon/goto-top.png'); ?>
                </a>
                <a href="#top">Hoch</a>
            </div>

            <div id="footer-center">
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