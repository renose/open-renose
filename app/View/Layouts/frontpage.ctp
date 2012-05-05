<!DOCTYPE html>
<html lang="en">
    <head>
	<meta charset="utf-8">
	<title>Twitter Bootstrap</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="">

	<!-- Le styles -->
	<?php
	echo $this->Html->css(array(
	    'frontpage/bootstrap',
	    'frontpage/bootstrap-responsive',
	    'frontpage/docs',
	    '../js/frontpage/google-code-prettify/prettify',
	    #'frontpage/slider'
	));

	echo $this->Html->script(array(
	    'frontpage/jquery',
	    'frontpage/google-code-prettify/prettify',
	    'frontpage/bootstrap-transition',
	    'frontpage/bootstrap-alert',
	    'frontpage/bootstrap-modal',
	    'frontpage/bootstrap-dropdown',
	    'frontpage/bootstrap-scrollspy',
	    'frontpage/bootstrap-tab',
	    'frontpage/bootstrap-tooltip',
	    'frontpage/bootstrap-popover',
	    'frontpage/bootstrap-collapse',
	    'frontpage/bootstrap-carousel',
	    'frontpage/bootstrap-typeahead',
	    'frontpage/application',
	    'frontpage/slider'
	));

	echo $this->Html->scriptblock("
$(function(){
  $('#slides').slides({
    width: 800, // [Number] Define the slide width
responsive: false, // [Boolean] slideshow will scale to its container
height: 400, // [Number] Define the slide height
navigation: true, // [Boolean] Auto generate the naviagation, next/previous buttons
pagination: true, // [Boolean] Auto generate the pagination
effects: {
 navigation: 'fade',  // [String] Can be either slide or fade
 pagination: 'fade' // [String] Can be either slide or fade
},
direction: 'left', // [String] Define the slide direction: Up, 'Right', 'Down', left'
fade: {
 interval: 1000, // [Number] Interval of fade in milliseconds
 crossfade: false, // [Boolean] TODO: add this feature. Crossfade the slides, great for images, bad for text
 easing: '' // [String] Dependency: jQuery Easing plug-in <http://gsgd.co.uk/sandbox/jquery/easing/>
},
slide: {
 interval: 1000, // [Number] Interval of fade in milliseconds
 browserWindow: false, // [Boolean] Slide in/out from browser window, bad ass
 easing: '' // [String] Dependency: jQuery Easing plug-in <http://gsgd.co.uk/sandbox/jquery/easing/>
},
preload: {
 active: true, // [Boolean] Preload the slides before showing them, this needs some work
 image: '../img/loading.gif' // [String] Define the path to a load .gif, yes I should do something cooler
},
startAtSlide: 1, // [Number] What should the first slide be?
playInterval: 5000, // [Number] Time spent on each slide in milliseconds
pauseInterval: 8000, // [Number] Time spent on pause, triggered on any navigation or pagination click
  });
 });

jQuery('#slides').ready(function() {
    $('#slides').slides('play');
});


");


	?>




	<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
	<!--[if lt IE 9]>
	  <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
    </head>

    <body data-spy="scroll" data-target=".subnav" data-offset="50">


	<!-- Navbar
	  ================================================== -->
	<div class="navbar navbar-fixed-top">
	    <div class="navbar-inner">
		<div class="container">
		    <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		    </a>
		    <a class="brand" href="./index.html">reNose</a>
		    <div class="nav-collapse collapse">
			<ul class="nav">
			    <li class="active">
				<a href="./index.html">Overview</a>
			    </li>
			    <li class="">
				<a href="./scaffolding.html">Scaffolding</a>
			    </li>
			    <li class="">
				<a href="./base-css.html">Base CSS</a>
			    </li>
			    <li class="">
				<a href="./components.html">Components</a>
			    </li>
			    <li class="">
				<a href="./javascript.html">Javascript plugins</a>
			    </li>
			    <li class="">
				<a href="./less.html">Using LESS</a>
			    </li>
			    <li class="divider-vertical"></li>
			    <li class="">
				<a href="./download.html">Customize</a>
			    </li>
			    <li class="">
				<a href="./examples.html">Examples</a>
			    </li>
			</ul>
		    </div>
		</div>
	    </div>
	</div>

	<div class="container">

	    <!-- Masthead
	    ================================================== -->
	    <header class="jumbotron masthead">

		<div class="inner">

		    <h1>Berichtsheft Verwaltung</h1>
		    <p>Kostenlos. Open Source. Jetzt anmelden.</p>

		    <div class="row">
		    <div class="span12">
			<div id="slides" style="margin:0 auto; width:800px;">
				<?= $this->Html->image('frontpage/slider/photos/1.jpg', array('alt' => 'Foo bar beschreibung', 'height' => '400', 'width' => '800')); ?>
				<?= $this->Html->image('frontpage/slider/photos/2.jpg', array('alt' => 'Foo bar beschreibung', 'height' => '400', 'width' => '800')); ?>
				<?= $this->Html->image('frontpage/slider/photos/3.jpg', array('alt' => 'Foo bar beschreibung', 'height' => '400', 'width' => '800')); ?>
			</div>


		    </div>
		</div>

		    <p class="download-info">
			<a href="https://github.com/twitter/bootstrap/" class="btn btn-primary btn-large">Jetzt kostenlos anmelden</a>
		    </p>
		</div>

		<div class="bs-links">
		    <ul class="quick-links">
			<li><a href="./upgrading.html">Upgrading from 1.4</a></li>
			<li><a href="https://github.com/twitter/bootstrap/zipball/master">Download with docs</a></li>
			<li><a href="http://blog.getbootstrap.com">Read the blog</a></li>
			<li><a href="https://github.com/twitter/bootstrap/issues?state=open">Submit issues</a></li>
			<li><a href="https://github.com/twitter/bootstrap/wiki">Roadmap and changelog</a></li>
		    </ul>
		</div>
	    </header>

	    <hr class="soften">

	    <div class="marketing">
		<h1>Was kann reNose?</h1>
		<p class="marketing-byline">Du suchst einen Grund, dich zu registrieren? Wir geben dir 30 Gründe!</p>

		<div class="row">
		    <div class="span4">
			<?= $this->Html->image('frontpage/glyphicons/glyphicons_042_group.png', array('class' => 'bs-icon')) ?>
			<h2>Built for and by nerds</h2>
			<p>Like you, we love building awesome products on the web. We love it so much, we decided to help people just like us do it easier, better, and faster. Bootstrap is built for you.</p>
		    </div>
		    <div class="span4">
			<?= $this->Html->image('frontpage/glyphicons/glyphicons_079_podium.png', array('class' => 'bs-icon')) ?>
			<h2>For all skill levels</h2>
			<p>Bootstrap is designed to help people of all skill levels&mdash;designer or developer, huge nerd or early beginner. Use it as a complete kit or use to start something more complex.</p>
		    </div>
		    <div class="span4">
			<?= $this->Html->image('frontpage/glyphicons/glyphicons_163_iphone.png', array('class' => 'bs-icon')) ?>
			<h2>Cross-everything</h2>
			<p>Originally built with only modern browsers in mind, Bootstrap has evolved to include support for all major browsers (even IE7!) and, with Bootstrap 2, tablets and smartphones, too.</p>
		    </div>
		</div><!--/row-->
		<div class="row">
		    <div class="span4">
			<?= $this->Html->image('frontpage/glyphicons/glyphicons_155_show_thumbnails.png', array('class' => 'bs-icon')) ?>
			<h2>12-column grid</h2>
			<p>Grid systems aren't everything, but having a durable and flexible one at the core of your work can make development much simpler. Use our built-in grid classes or roll your own.</p>
		    </div>
		    <div class="span4">
			<?= $this->Html->image('frontpage/glyphicons/glyphicons_214_resize_small.png', array('class' => 'bs-icon')) ?>
			<h2>Responsive design</h2>
			<p>With Bootstrap 2, we've gone fully responsive. Our components are scaled according to a range of resolutions and devices to provide a consistent experience, no matter what.</p>
		    </div>
		    <div class="span4">
			<?= $this->Html->image('frontpage/glyphicons/glyphicons_266_book_open.png', array('class' => 'bs-icon')) ?>
			<h2>Styleguide docs</h2>
			<p>Unlike other front-end toolkits, Bootstrap was designed first and foremost as a styleguide to document not only our features, but best practices and living, coded examples.</p>
		    </div>
		</div><!--/row-->
		<div class="row">
		    <div class="span4">
			<?= $this->Html->image('frontpage/glyphicons/glyphicons_082_roundabout.png', array('class' => 'bs-icon')) ?>
			<h2>Growing library</h2>
			<p>Despite being only 10kb (gzipped), Bootstrap is one of the most complete front-end toolkits out there with dozens of fully functional components ready to be put to use.</p>
		    </div>
		    <div class="span4">
			<?= $this->Html->image('frontpage/glyphicons/glyphicons_009_magic.png', array('class' => 'bs-icon')) ?>
			<h2>Custom jQuery plugins</h2>
			<p>What good is an awesome design component without easy-to-use, proper, and extensible interactions? With Bootstrap, you get custom-built jQuery plugins to bring your projects to life.</p>
		    </div>
		    <div class="span4">
			<?= $this->Html->image('frontpage/less-small.png', array('class' => 'bs-icon')) ?>
			<h2>Built on LESS</h2>
			<p>Where vanilla CSS falters, LESS excels. Variables, nesting, operations, and mixins in LESS makes coding CSS faster and more efficient with minimal overhead.</p>
		    </div>
		</div><!--/row-->
		<div class="row">
		    <div class="span3">
			<?= $this->Html->image('frontpage/icon-html5.png', array('class' => 'small-bs-icon')) ?>
			<h3>HTML5</h3>
			<p>Built to support new HTML5 elements and syntax.</p>
		    </div>
		    <div class="span3">
			<?= $this->Html->image('frontpage/icon-css3.png', array('class' => 'small-bs-icon')) ?>
			<h3>CSS3</h3>
			<p>Progressively enhanced components for ultimate style.</p>
		    </div>
		    <div class="span3">
			<?= $this->Html->image('frontpage/icon-github.png', array('class' => 'small-bs-icon')) ?>
			<h3>Open-source</h3>
			<p>Built for and maintained by the community via <a href="https://github.com">GitHub</a>.</p>
		    </div>
		    <div class="span3">
			<?= $this->Html->image('frontpage/icon-twitter.png', array('class' => 'small-bs-icon')) ?>
			<h3>Made at Twitter</h3>
			<p>Brought to you by an experienced <a href="http://twitter.com/fat">engineer</a> and <a href="http://twitter.com/mdo">designer</a>.</p>
		    </div>
		</div><!--/row-->

	    </div><!-- /.marketing -->

	    <!-- Footer
	     ================================================== -->
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
