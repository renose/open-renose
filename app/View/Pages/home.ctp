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
		<?= $this->Html->image('frontpage/frontpage-reports-renose.png', array('alt' => 'open reNose - Berichtsübersicht', 'class' => 'teaser-image')); ?>
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
    <p class="marketing-byline">Die Vorteile von reNose:</p>

    <div class="row">
	<div class="span4">
	    <?= $this->Html->image('icons/solutions.png', array('class' => 'bs-icon')) ?>
	    <h2>Einfache Bedienung</h2>
	    <p>Wir haben viel Wert auf einfache Bedienung gelegt, damit dich auf das Kernthema konzentrieren kannst: Berichte erstellen.</p>
	</div>
	<div class="span4">
	    <?= $this->Html->image('icons/clipboard.png', array('class' => 'bs-icon')) ?>
	    <h2>Berichtsübersicht</h2>
	    <p>In der Jahresübersicht siehst du, welche Wochen du noch nicht eingetragen hast und kannst dies sofort nachholen.</p>
	</div>
        <div class="span4">
            <?= $this->Html->image('icons/book_stack.png', array('class' => 'bs-icon')) ?>
            <h2>Berufsschulthemen</h2>
            <p>Berufsschulthemen können bequem anhand des Stundenplanes eingetragen werden.</p>
        </div>
    </div><!--/row-->
    <div class="row">
        <div class="span4">
	    <?= $this->Html->image('icons/businessman.png', array('class' => 'bs-icon')) ?>
	    <h2>Unterweisungen</h2>
	    <p>Hattest du Schulungen oder Lehrgespräche? Diese können seperat eingetragen werden.</p>
	</div>
        <div class="span4">
	    <?= $this->Html->image('icons/console.png', array('class' => 'bs-icon')) ?>
	    <h2>Webbasierte Anwendung</h2>
	    <p>reNose ist eine Webapplikation, du kannst somit von überall auf deine Daten zugreifen und Berichte hinzufügen. Benötigt wird nur ein Browser.</p>
	</div>
        <div class="span4">
	    <?= $this->Html->image('icons/pdf.png', array('class' => 'bs-icon')) ?>
	    <h2>PDF Export</h2>
	    <p>Du kannst das komplette Berichtsheft fertig formatiert als PDF speichern und ausdrucken.</p>
	</div>
    </div>

</div>