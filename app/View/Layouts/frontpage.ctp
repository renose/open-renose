<!DOCTYPE html>
<html lang="en">
    <head>
        <?php echo $this->Html->charset(); ?>
        <title><?= $title_for_layout.' - open reNose'; ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php
        echo $this->Html->meta('icon');

        echo $this->Html->css(array(
    	    'frontpage/bootstrap',
	    'frontpage/bootstrap-responsive',
	    'frontpage/docs',
	    'frontpage/frontpage'
        ));

        echo $this->Html->script(array(
            'jquery-1.7.2.min',
            'frontpage/bootstrap-collapse'
        ));

        echo $scripts_for_layout;
        ?>

	<!--[if lt IE 9]>
	  <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->

    </head>

    <body data-spy="scroll" data-target=".subnav" data-offset="50">


	<!-- Navbar
	  ================================================== -->
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
	    if(isset($isHomeSite)) {
		echo $this->element('frontpage/home', array(), array(/*'cache' => '+1 day'*/));
	    } else {
		echo $content_for_layout;
	    }
	    ?>

	    <footer class="footer">
		<p class="pull-right"><a href="#">Back to top</a></p>
		<p>&copy; 2012 by <a href="mailto:simon@renose.de">Simon Wörner</a>,
		    <a href="mailto:patrick@renose.de">Patrick Hafner</a> & <a href="mailto:daniel@renose.de">Daniel Greiner</a> |
		    <a href="http://www.renose.de">renose.de</a></p>
		<p>Icons from <a href="http://glyphicons.com">Glyphicons Free</a>, licensed under <a href="http://creativecommons.org/licenses/by/3.0/">CC BY 3.0</a>.</p>
	    </footer>

	</div><!-- /container -->
    </body>
</html>
