<?php
/* 
 * users.php
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
    $this->Html->addCrumb('Groups', 'display');
    $this->Html->addCrumb('Edit Group Users', null);
    //$this->Html->addCrumb($page['Page']['description'], '/page/edit/' . $page['Page']['title']);
?>

<table width="100%" class="admintable">
	<tr>
		<th>User-ID</th>
		<th>Email</th>
		<th>Aktionen</th>
	</tr>

	<?php foreach ($users as $user): ?>
	<tr>
		<td><?php echo $user['id']; ?></td>
		<td><?php echo $user['email']; ?></td>
		<td>
			<?php
                            echo $this->Html->link(
                                $this->Html->image("icon/delete.png", array("alt" => "User entfernen", "align" => "center")),
                                array('action' => 'delete', $user['id']), array('escape' => false),
                                'Wollen Sie die Gruppe <' . $user['email'] . '> wirklich löschen?');
                        ?>
		</td>
	</tr>
	<?php endforeach; ?>

</table>

<?php
    pr($users);
?>