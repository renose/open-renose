<?php

/*
 * home.ctp
 * 
 * Copyright (c) 2011-2012 open reNose team <info at renose.de>.
 * Simon Wörner, Patrick Hafner and Daniel Greiner.
 * 
 * This file is part of open reNose.
 * 
 * open reNose is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 * 
 * open reNose is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * 
 * You should have received a copy of the GNU General Public License
 * along with open reNose.  If not, see <http ://www.gnu.org/licenses/>.
 */
?>

<header class="jumbotron masthead">

    <div class="inner">

	<h1>Berichtsheft Verwaltung</h1>
	<p>Kostenlos. Open Source. Jetzt anmelden.</p>

	<div class="row">
	    <div class="span12">
		<?= $this->Html->image('frontpage/frontpage-reports-renose.png', array('alt' => 'Foo bar beschreibung', 'class' => 'teaser-image')); ?>
	    </div>
	</div>

	<p class="download-info">
	    <?=
	    $this->Html->link('Jetzt kostenlos anmelden!', array(
		'controller' => 'users',
		'action' => 'register'
		),
		array(
		    'class' => 'btn btn-primary btn-large'
		)
	    );
	    ?>
	</p>
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

</div>