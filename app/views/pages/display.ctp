<h1>
    <?php echo $title_for_layout; ?>
</h1>

<table width="100%">
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
			<?php echo $html->link($page['Page']['description'], "/pages/view/".$page['Page']['title']); ?>
		</td>
		<td>
			<?php
                            echo $html->link(
                                $this->Html->image("icon/edit.png", array("alt" => "Seite erstellen")) . 'Bearbeiten',
                                array('action' => 'edit', $page['Page']['id']), array('escape' => false) );

                            echo " ";

                            echo $html->link(
                                $this->Html->image("icon/delete.png", array("alt" => "Seite erstellen")) . 'Löschen',
                                array('action' => 'delete', $page['Page']['id']), array('escape' => false),
                                'Wollen Sie die Seite "' . $page['Page']['description'] . '" wirklich löschen?' );
                        ?>
		</td>
		<td><?php echo $page['Page']['created']; ?></td>
		<td><?php echo $page['Page']['modified']; ?></td>
	</tr>
	<?php endforeach; ?>

</table>

<?php
    echo $html->link(
            $this->Html->image("icon/add.png", array("alt" => "Seite erstellen")) . 'Seite erstellen',
            array('controller' => 'pages', 'action' => 'add'),
            array('escape' => false));
    //icon/add.png
?>