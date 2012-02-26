<h1>Adminpanel</h1>
<div id="menubox">
    <ul>
	<li id="test"><a href="#seiten">Seiten</a></li>
	<li><a href="#system">System</a></li>
	<li><a href="#benutzer">Benutzer</a></li>
    </ul>

<div id="seiten">
    <a href="<?php $this->eprint(BASE_URL . '/editPage?id=new'); ?>"><img src="<?php $this->eprint(BASE_URL . '/tpl/files/images/add.png'); ?>" alt="" /></a>
    <table width="100%">
	<tr>
	    <th>ID</th>
	    <th>Überschrift</th>
	    <th>Beschreibung</th>
	    <th></th>
	    <!--<th></th>-->
	</tr>

    <?php foreach ($this->pageList as $key => $page): ?>
        <tr>
	    <td><?php $this->eprint($page['id']); ?></td>
	    <td><?php $this->eprint($page['title']); ?></td>
	    <td><?php $this->eprint(substr($page['description'], 0, 50)); ?></td>
	    <td><a href="<?php $this->eprint(BASE_URL . '/editPage?id=' . $page['id']); ?>"><img src="<?php $this->eprint(BASE_URL . '/tpl/files/images/edit.png'); ?>" alt="Editieren" /></a></td>
	    <!--<td><a href="<?php $this->eprint(BASE_URL . '/deletePage?id=' . $page['id']); ?>"><img src="<?php $this->eprint(BASE_URL . '/tpl/files/images/delete.png'); ?>" alt="Löschen" /></a></td>-->
        </tr>
    <?php endforeach; ?>
    </table>
</div>

<div id="system">
    <table width="100%">
    <?php foreach ($this->settingList as $key => $setting): ?>
        <tr>
	    <td><p><?php $this->eprint($setting['property']); ?> :</p></td>
	    <td><input type="text" name="<?php $this->eprint($setting['property']); ?>" value="<?php $this->eprint($setting['value']); ?>"></td>
        </tr>
    <?php endforeach; ?>
    	<tr>
	    <td colspan="2">
		<input type="submit" value="Einstellungen speichern" />
	    </td>
	</tr>
    </table>
</div>


<div id="benutzer">
    <a href="<?php $this->eprint(BASE_URL . '/editPage?id=new'); ?>"><img src="<?php $this->eprint(BASE_URL . '/tpl/files/images/add.png'); ?>" alt="" /></a>
    <table width="100%">
	<tr>
	    <th>ID</th>
	    <th>Username</th>
	    <th>isAdmin</th>
	    <th>Voller Name</th>
	    <th>Bearbeiten</th>
	</tr>

    <?php foreach ($this->userList as $key => $user): ?>
        <tr>
	    <td><?php $this->eprint($user['id']); ?></td>
	    <td><?php $this->eprint($user['username']); ?></td>
	    <td><?php $this->eprint($user['isAdmin']); ?></td>
	    <td><?php $this->eprint($user['prename']); ?> <?php $this->eprint($user['name']); ?></td>
	    <td><a href="<?php $this->eprint(BASE_URL . '/editPage?id=' . $user['id']); ?>"><img src="<?php $this->eprint(BASE_URL . '/tpl/files/images/edit.png'); ?>" alt="Editieren" /></a></td>
        </tr>
    <?php endforeach; ?>
    </table>
</div>



</div>