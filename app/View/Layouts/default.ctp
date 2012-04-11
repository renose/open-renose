<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <?php echo $this->Html->charset(); ?>
        <title><?= $title_for_layout.' - open reNose'; ?></title>
        <?php
        echo $this->Html->meta('icon');

        echo $this->Html->css(array(
            'style',
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
        <div id="container">
            <div id="wrapper">
                <div id="header">
                    <a href="<?php echo $this->Html->url('/', true); ?>">
                        <h1 id="logo">
                            <span>open</span>reNose
                        </h1>
                    </a>
                    <div id="headerinfo">
                        <?php echo $this->element('userinfo'); ?>
                    </div>
                </div>
                <div id="navigation">
                    <?php echo $this->element('navigation', array('menu' => 'main', 'cache' => '+3 hour')); ?>
                </div>
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

                    <div style="background: aliceblue">
                        <?php echo $this->element('sql_dump'); ?>
                    </div>
                </div>
            </div>
            <div id="trenner"></div>
            <div id="footer">
                <div id="footerwrapper">
                    <div class="footerbox">
                        <ul>
                            <li class="headline">Navigation</li>
                            <?php echo $this->element('navigation', array('menu' => 'footer', 'cache' => '+3 hour')); ?>
                        </ul>
                    </div>

                    <div class="footerbox">
                        <ul>
                            <li class="headline">Dev Links</li>
                            <?php echo $this->element('navigation', array('menu' => 'dev', 'cache' => '+3 hour')); ?>
                        </ul><br/>

                        <?php
                        echo $this->Html->link(
                                $this->Html->image('cake.power.gif', array('alt' => __('CakePHP: the rapid development php framework'), 'border' => '0')), 'http://www.cakephp.org/', array('target' => '_blank', 'escape' => false)
                        );
                        ?>
                    </div>

                    <div class="footerbox lastbox">
                        <p class="floatright">
                            Page rendered in <?php echo round((microtime(true) - $_SERVER['REQUEST_TIME']) * 1000) ?>ms</p>
                        <p class="floatright">2011 by
                            <a href="mailto:simon@renose.de">Simon Wörner</a> und
                            <a href="mailto:patrick@renose.de">Patrick Hafner</a> |
                            <a href="http://www.renose.de">renose.de</a></p>
                    </div>
                </div>
            </div>
        </div>
<?php echo $this->Js->writeBuffer(); ?>
    </body>
</html>