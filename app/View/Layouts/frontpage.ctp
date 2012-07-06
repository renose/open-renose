<!DOCTYPE html>
<html lang="de">
    <head>
        <?php echo $this->Html->charset(); ?>
        <title><?= $title_for_layout.' - open reNose'; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php
        echo $this->Html->meta('icon');

        echo $this->Html->css(array(
            'jquery.jgrowl',
            'frontpage/bootstrap',
        'frontpage/bootstrap-responsive',
        'frontpage/docs',
        'frontpage/frontpage'
        ));

        echo $this->Html->script(array(
            'jquery.min',
            'jquery.jgrowl.min',
            'frontpage/bootstrap-collapse'
        ));

        echo $scripts_for_layout;
        ?>

    <!--[if lt IE 9]>
      <script src="https://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    </head>

    <body data-spy="scroll" data-target=".subnav" data-offset="50">

    <div class="navbar navbar-fixed-top">
        <div class="navbar-inner">
        <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
        <div class="container">
            <div class="nav-collapse collapse">
            <?= $this->element('frontpage/navigation'); ?>
            <ul class="nav pull-right">
                <li>
                <?= $this->element('frontpage/navigation.login'); ?>
                </li>
            </ul>
            </div>
        </div>
        </div>
    </div>

    <div class="container">

            <?php
            echo $this->Session->flash();
            echo $this->Session->flash('auth');
            echo $this->Session->flash('email');
            ?>

        <?php echo $content_for_layout; ?>

        <footer class="footer">
        <p class="pull-right">
                    <a href="#" class="icon-goto-top">
                        <?php echo $this->Html->image('icons/up.png'); ?>
                    </a>
                    <a href="#">Back to top</a>
                </p>

        <p>
            &copy; 2012 by
            <a href="mailto:simon@renose.de">Simon Wörner</a>,
            <a href="mailto:patrick@renose.de">Patrick Hafner</a> &
            <a href="mailto:daniel@renose.de">Daniel Greiner</a> |
            <?= $this->Html->link('Impressum', '/page/legal') ?>
        </p>
        </footer>
    </div>
        
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
