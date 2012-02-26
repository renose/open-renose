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
    $html->addCrumb('Groups', 'display');
?>

<h1><?php echo $title_for_layout; ?></h1>

<table width="100%" class="admintable">
	<tr>
		<th>ID</th>
		<th>Name</th>
		<th>Beschreibung</th>
		<th>Aktionen</th>
	</tr>

	<?php foreach ($groups as $group): ?>
	<tr>
		<td><?php echo $group['Group']['id']; ?></td>
		<td><?php echo $group['Group']['name']; ?></td>
		<td><?php echo $group['Group']['description']; ?></td>
		<td>
			<?php
                            echo $html->link(
                                $this->Html->image("icon/key.png", array("alt" => "Gruppenrechte bearbeiten", "align" => "center")),
                                array('action' => 'permissions', $group['Group']['name']), array('escape' => false) );

                            echo " ";

                            echo $html->link(
                                $this->Html->image("icon/user.png", array("alt" => "Gruppenbenutzer bearbeiten", "align" => "center")),
                                array('action' => 'users', $group['Group']['name']), array('escape' => false) );

                            echo " ";

                            echo $html->link(
                                $this->Html->image("icon/edit.png", array("alt" => "Gruppe bearbeiten", "align" => "center")),
                                array('action' => 'edit', $group['Group']['name']), array('escape' => false) );

                            echo " ";

                            echo $html->link(
                                $this->Html->image("icon/delete.png", array("alt" => "Gruppe löschen", "align" => "center")),
                                array('action' => 'delete', $group['Group']['name']), array('escape' => false),
                                'Wollen Sie die Gruppe <' . $group['Group']['description'] . '> wirklich löschen?');
                        ?>
		</td>
	</tr>
	<?php endforeach; ?>

</table>

<?php
    echo $html->link(
            $this->Html->image("icon/add.png", array("alt" => "Seite erstellen", "align" => "center", "id" => "ico-addpage")),
            array('controller' => 'groups', 'action' => 'add'),
            array('escape' => false));
?>