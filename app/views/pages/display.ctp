<h1>Pages Overview</h1>
<table>
	<tr>
		<th>ID</th>
		<th>Title</th>
		<th>Description</th>
		<th>Actions</th>
		<th>Created</th>
		<th>Modified</th>
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
			<?php echo $html->link('Edit', array('action' => 'edit', $page['Page']['id']) )?>
			<?php echo $html->link('Delete', array('action' => 'delete', $page['Page']['id']), null, 'Are you sure?' )?>
		</td>
		<td><?php echo $page['Page']['created']; ?></td>
		<td><?php echo $page['Page']['modified']; ?></td>
	</tr>
	<?php endforeach; ?>

</table>

<?php echo $html->link('Page hinzufügen', array('controller' => 'pages', 'action' => 'add'))?>