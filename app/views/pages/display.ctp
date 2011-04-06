<h1>Blog posts</h1>
<table>
	<tr>
		<th>Id</th>
		<th>Title</th>
		<th>Created</th>
	</tr>

	<!-- Hier iterieren wir in einer Schleife durch den $posts Array und geben die Daten des aktuellen Elements ausHere -->

	<?php foreach ($pages as $page): ?>
	<tr>
		<td><?php //echo $page['Page']['title']; ?></td>
		<td>
			<?php echo $html->link($page['Page']['description'], "/pages/view/".$page['Page']['title']); ?>
		</td>
		<td><?php echo $page['Page']['created']; ?></td>
	</tr>
	<?php endforeach; ?>

</table>