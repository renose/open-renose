<?php
/* 
 * permissions.ctp
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
    $html->addCrumb('Edit Group Permissions', null);
    //$html->addCrumb($page['Page']['description'], '/page/edit/' . $page['Page']['title']);
?>

<div id="permissions-content">
<?php foreach ($controllers as $controller => $actions): ?>
<table width="100%" class="admintable">
	<tr>
		<th>Action</th>
		<th>Status</th>
		<th>Aktionen</th>
	</tr>
    <p><b><?php echo "$controller"; ?></b></p>
    <?php foreach ($actions as $action => $permission): ?>
    <tr>
        <td><?php echo $action; ?></td>

        <td>
            <?php
                switch($permission)
                {
                    case '+':
                        echo $this->Html->image("icon/accept.png", array("alt" => "Erlaubt", "align" => "center"));
                        break;

                    case '-':
                        echo $this->Html->image("icon/cancel.png", array("alt" => "Verboten", "align" => "center"));
                        break;

                    default:
                        echo '[permission not found] ';
                    case '0':
                        echo $this->Html->image("icon/page_white.png", array("alt" => "Nicht gesetzt", "align" => "center"));
                        break;
                }
            ?>
        </td>

        <td>
            <?php
                switch($permission)
                {
                    case '+':
                        echo $ajax->link(
                            $this->Html->image("icon/cancel.png", array("alt" => "Seite editieren", "align" => "center")),
                            array('action' => 'permissions', $group['Group']['name'], 'deny', $controller, $action),
                            array('update' => 'permissions-content', 'escape' => false) );
                        echo ' ';
                        echo $ajax->link(
                            $this->Html->image("icon/delete.png", array("alt" => "Seite editieren", "align" => "center")),
                            array('action' => 'permissions', $group['Group']['name'], 'delete', $controller, $action),
                            array('update' => 'permissions-content', 'escape' => false) );
                        break;

                    case '-':
                        echo $ajax->link(
                            $this->Html->image("icon/accept.png", array("alt" => "Seite editieren", "align" => "center")),
                            array('action' => 'permissions', $group['Group']['name'], 'allow', $controller, $action),
                            array('update' => 'permissions-content', 'escape' => false) );
                        echo ' ';
                        echo $ajax->link(
                            $this->Html->image("icon/delete.png", array("alt" => "Seite editieren", "align" => "center")),
                            array('action' => 'permissions', $group['Group']['name'], 'delete', $controller, $action),
                            array('update' => 'permissions-content', 'escape' => false) );
                        break;

                    default:
                        echo '[permission not found] ';
                    case '0':
                        echo $ajax->link(
                            $this->Html->image("icon/accept.png", array("alt" => "Seite editieren", "align" => "center")),
                            array('action' => 'permissions', $group['Group']['name'], 'allow', $controller, $action),
                            array('update' => 'permissions-content', 'escape' => false) );
                        echo ' ';
                        echo $ajax->link(
                            $this->Html->image("icon/cancel.png", array("alt" => "Seite editieren", "align" => "center")),
                            array('action' => 'permissions', $group['Group']['name'], 'deny', $controller, $action),
                            array('update' => 'permissions-content', 'escape' => false) );
                        break;
                }
            ?>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
<br/>
<?php endforeach; ?>
</div>