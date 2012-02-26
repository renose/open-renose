<?php
/*
 * edit.ctp
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

<?php  echo $javascript->link('ckeditor/ckeditor', NULL, false);  ?> 
<h1>
    <?php echo $title_for_layout; ?>
</h1>

<?php
    echo $form->create('Page');
    
    echo $form->input('title', array('label' => 'URL-Titel'));
    echo $form->input('description', array('label' => 'Überschrift'));

    echo $form->input('body', array('rows' => '5', 'label' => 'Inhalt'));
    echo $fck->load('Page.body');

    echo $form->end('Änderungen speichern');
?>