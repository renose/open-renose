<a href="<?php $this->eprint(BASE_URL . '/editPage?id=new'); ?>"><img src="<?php $this->eprint(BASE_URL . '/tpl/files/images/add.png'); ?>" alt="" /></a>
<table width="100%">
    <tr>
	<td>ID</td>
	<td>Überschrift</td>
	<td>Beschreibung</td>
	<td></td>
	<!--<td></td>-->
    </tr>

    <?php foreach ($this->pageList as $key => $page): ?>
        <tr>
    	<td><?php $this->eprint($page['id']); ?></td>
    	<td><?php $this->eprint($page['title']); ?></td>
    	<td><?php $this->eprint(substr($page['description'], 0, 30)); ?></td>
    	<td><a href="<?php $this->eprint(BASE_URL . '/editPage?id=' . $page['id']); ?>"><img src="<?php $this->eprint(BASE_URL . '/tpl/files/images/edit.png'); ?>" alt="Editieren" /></a></td>
    	<!--<td><a href="<?php $this->eprint(BASE_URL . '/deletePage?id=' . $page['id']); ?>"><img src="<?php $this->eprint(BASE_URL . '/tpl/files/images/delete.png'); ?>" alt="Löschen" /></a></td>-->
        </tr>
    <?php endforeach; ?>
</table>