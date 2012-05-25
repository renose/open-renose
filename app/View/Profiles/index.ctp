<?php
/*
 * index.ctp
 * 
 * Copyright (c) 2011-2012 open reNose team <info at renose.de>.
 * Simon Wörner, Patrick Hafner and Daniel Greiner.
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

<h1>
    <?php echo $this->Html->image('icons/user.png'); ?>
    Profil
</h1>
<br/>

<?php
echo $this->Form->create('Profile');
echo $this->Form->hidden('id');

echo $this->Form->input('first_name', array('label' => 'Vorname'));
echo $this->Form->input('last_name', array('label' => 'Nachname'));

echo $this->Form->input('job_name', array('label' => 'Beruf', 'type' => 'text'));

echo $this->Form->input('birthday', array('label' => 'Geburtstag'));
echo $this->Form->input('birthplace', array('label' => 'Geburtsort'));

echo $this->Form->input('zip_code', array('label' => 'Postleizahl'));
echo $this->Form->input('city', array('label' => 'Stadt'));
echo $this->Form->input('street', array('label' => 'Straße'));

echo $this->Form->end('Speichern');
?>

<?php pr($jobs); ?>

<script type="text/javascript">
    $(function() {
        var availableTags = [
            "<?php echo implode('", "', $jobs); ?>"
        ];
        $( "#ProfileJobName" ).autocomplete({
            source: availableTags
        });
    });
</script>
