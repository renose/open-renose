<table width="100%">
    <tr>
	<td>ID</td>
	<td>Überschrift</td>
	<td>Inhalt</td>
	<td>Edit</td>
	<td>Del</td>
    </tr>

    <?php foreach ($this->pageList as $key => $page): ?>
        <tr>
    	<td><?php $this->eprint($page['id']); ?></td>
    	<td><?php $this->eprint($page['title']); ?></td>
    	<td><?php $this->eprint(substr($page['value'], 0, 30)); ?></td>
    	<td><a href="<?php $this->eprint(BASE_URL . '/editPage/' . $page['id']); ?>">Edit</a></td>
    	<td><a href="<?php $this->eprint(BASE_URL . '/deletePage/' . $page['id']); ?>">Del</a></td>
        </tr>
    <?php endforeach; ?>
</table>\ No newline at end of file
