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

	<h1>Berichtsheft-Verwaltung</h1>
	<p>Kostenlos, einfach und online</p>

	<div class="row">
	    <div class="span12">
		<?= $this->Html->image('frontpage/frontpage-reports-renose.png', array('alt' => 'open reNose - Berichtsübersicht', 'class' => 'teaser-image')); ?>
	    </div>
	</div>

	<p class="download-info">
	    <?=
	    $this->Html->link('Jetzt kostenlos anmelden!',
			array('controller' => 'users', 'action' => 'register'),
			array('class' => 'btn btn-primary btn-large')
		);
	    ?>
	</p>
    </div>

</header>

<hr class="soften">

<div class="marketing">
    <h1>Was kann reNose?</h1>
    <p class="marketing-byline">Die Vorteile von reNose</p>

    <div class="row">
		<div class="span4">
			<?= $this->Html->image('icons/solutions.png', array('class' => 'bs-icon')) ?>
			<h2>Einfache Bedienung</h2>
			<p>Wir haben viel Wert auf einfache Bedienung gelegt. Damit du schnell und ohne Aufwand deine Berichte erstellen kannst.</p>
		</div>
		
		<div class="span4">
			<?= $this->Html->image('icons/clipboard.png', array('class' => 'bs-icon')) ?>
			<h2>Berichtsübersicht</h2>
			<p>In der Jahresübersicht siehst du sofort welche Berichte bereits erledigt sind und welche noch zu machen sind.</p>
		</div>
		
		<div class="span4">
			<?= $this->Html->image('icons/planner.png', array('class' => 'bs-icon')) ?>
			<h2>Stundenplan</h2>
			<p>Du hast die Möglichkeit deinen Stundenplan bequem einzutragen, dieser wird für die Schulthemen im Bericht verwendet.</p>
		</div>
    </div>
	
    <div class="row">
		<div class="span4">
			<?= $this->Html->image('icons/globe.png', array('class' => 'bs-icon')) ?>
			<h2>Webbasierte Anwendung</h2>
			<p>Bei reNose handelt es sich um eine Webanwendung, die dir von überall Zugriff auf deine Berichte bietet. Du benötigst lediglich einen Internetzugang und einen Browser.</p>
		</div>
		
		<div class="span4">
			<?= $this->Html->image('icons/pdf.png', array('class' => 'bs-icon')) ?>
			<h2>PDF-Export</h2>
			<p>Das komplette Berichtsheft oder auch nur einzelne Seiten lassen sich fertig formatiert als PDF exportieren.</p>
		</div>
		
		<div class="span4">
			<?= $this->Html->image('icons/settings2.png', array('class' => 'bs-icon')) ?>
			<h2>Aktive Entwicklung</h2>
			<p>Wir sind aktiv mit der Entwicklung von reNose beschäftigt, wir arbeiten an neuen Funktionen und Verbesserung. </p>
		</div>
    </div>

</div>