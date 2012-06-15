<h1>Export</h1>
<?php
echo $this->Form->create();

echo $this->Form->input('overview', array('label' => 'Deckblatt?', 'type' => 'checkbox'));
echo $this->Form->input('activityList', array('label' => 'Übersichtsseiten?', 'type' => 'checkbox'));
echo '<p>Es werden alle Berichte exportiert.</p><p>Für einzelne Berichte über die Wochenansicht gehen.</p>';
echo $this->Form->submit('Exportieren');
echo $this->Form->end();