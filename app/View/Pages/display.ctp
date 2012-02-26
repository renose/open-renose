<?php
/*
 * display.ctp
 *
 * Copyright (c) 2011 open reNose team <info at renose.de>.
 * Simon Wörner and Patrick Hafner.
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
<?php
    $this->Html->addCrumb('Pages', 'display');
?>

<h1><?php echo $title_for_layout; ?></h1>

<table width="100%" class="admintable">
	<tr>
		<th>ID</th>
		<th>URL-Titel</th>
		<th>Überschrift</th>
		<th>Aktionen</th>
		<th>Erstellt</th>
		<th>Letzte Änderung</th>
	</tr>

	<!-- Hier iterieren wir in einer Schleife durch den $posts Array und geben die Daten des aktuellen Elements ausHere -->
	<?php foreach ($pages as $page): ?>
	<tr>
		<td><?php echo $page['Page']['id']; ?></td>
		<td><?php echo $page['Page']['title']; ?></td>
		<td>
			<?php echo $this->Html->link($page['Page']['description'], "/pages/view/".$page['Page']['title']); ?>
		</td>
		<td>
			<?php
                            echo $this->Html->link(
                                $this->Html->image("icon/edit.png", array("alt" => "Seite editieren", "align" => "center")),
                                array('action' => 'edit', $page['Page']['title']), array('escape' => false) );

                            echo " ";

                            echo $this->Html->link(
                                $this->Html->image("icon/delete.png", array("alt" => "Seite löschen", "align" => "center")),
                                array('action' => 'delete', $page['Page']['title']), array('escape' => false),
                                'Wollen Sie die Seite <' . $page['Page']['description'] . '> wirklich löschen?');
                        ?>
		</td>
		<td><?php echo $page['Page']['created']; ?></td>
		<td><?php echo $page['Page']['modified']; ?></td>
	</tr>
	<?php endforeach; ?>

</table>

<?php
    echo $this->Html->link(
            $this->Html->image("icon/add.png", array("alt" => "Seite erstellen", "align" => "center", "id" => "ico-addpage")),
            array('controller' => 'pages', 'action' => 'add'),
            array('escape' => false));
?>