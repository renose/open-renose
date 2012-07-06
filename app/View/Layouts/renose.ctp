<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <?php echo $this->Html->charset(); ?>
        <title><?= $title_for_layout.' - open reNose'; ?></title>
        <?php
        echo $this->Html->meta('icon');

        echo $this->Html->css(array(
            'https://fonts.googleapis.com/css?family=Open+Sans',
            'ui-lightness/jquery-ui.custom',
            'jquery.jgrowl',
            'cake.generic',
            'renose/wysihtml5',
            'renose/screen',
            'renose/calender',
            'renose/schedule',
            'renose/jquery.loadindicator',
            'renose/report',
            'renose/tipTip'
        ));

        echo $this->Html->script(array(
            'Math.uuid',
            'jquery.min',
            'jquery-ui.custom.min',
            'jquery.jeditable',
            'jquery.jeditable.wysihtml5',
            'jquery.jgrowl.min',
            'wysihtml5/parser_rules/simple',
            'wysihtml5/wysihtml5.min',
            'jquery.tipTip.minified',
            'jquery.loadindicator',
            'jquery.renose.editbox',
            'jquery.renose.editfield',
            'jquery.renose.tableeditfield',
            'jquery.renose.load'
        ));

        echo $scripts_for_layout;
        ?>
    </head>
    <body>
        <header>
            <div id="logo">
                <a href="<?php echo $this->Html->url('/reports/display', true); ?>">
                    <span>open</span>reNose
                </a>
            </div>
            <!--
            <div id="global-search">
                <form>
                    <input type="search" placeholder="Global suchen..." />
                    <input type="submit" value="" />
                </form>
            </div>
            -->
            <div id="headerinfo">
                <?php
                if($this->Session->read('Auth.User'))
                    echo 'Hallo <b>' . $this->requestAction('/users/get_name') . '</b>.';
                ?>
                <?php echo $this->Html->link('Ausloggen', '/users/logout'); ?>
            </div>
        </header>

        <nav id="sidebar">
            <?php echo $this->element('renose/sidebar'); ?>
        </nav>

        <nav id="breadcrumb">
            <?php echo $this->Html->getCrumbs(' > '); ?>
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
            <?php else: ?>
            <div id="footer-left">Icons by <a href="http://icons8.com/">Icons8</div>
            <?php endif; ?>

            <div id="footer-right">
                <a class="icon-goto-top" href="#top">
                    <?php echo $this->Html->image('icons_white/up.png'); ?>
                </a>
                <a href="#top">Hoch</a>
            </div>

            <div id="footer-center">
                (c) 2012 by
                <a href="mailto:simon@renose.de">Simon Wörner</a>,
                <a href="mailto:patrick@renose.de">Patrick Hafner</a> and
                <a href="mailto:daniel@renose.de">Daniel Greiner</a> |
                <a href="https://renose.de">renose.de</a></p>
            </div>
        </footer>
        
        <script type="text/javascript">
            $('#content').ajaxError(function(e, jqxhr, settings, exception) {
                console.log({'ajaxError': {
                    e: e,
                    jqxhr: jqxhr,
                    settings: settings,
                    exception: exception
                }});
                $.jGrowl('Interner Fehler', { header: 'Fehler', life: 10000 });
            });
        </script>
        <?php echo $this->Js->writeBuffer(); ?>
    </body>
</html>