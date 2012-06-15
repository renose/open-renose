<h1>Export</h1>
<?php
echo $this->Form->create();

echo $this->Form->input('overview', array('label' => 'Deckblatt', 'type' => 'checkbox', 'checked' => 'checked'));
echo $this->Form->input('activityList', array('label' => 'Übersichtsseiten', 'type' => 'checkbox', 'checked' => 'checked'));
echo $this->Form->input('allReports', array('label' => 'Alle Berichte exportieren', 'type' => 'checkbox', 'checked' => 'checked'));
echo '<p>Falls gewählt, werden alle Berichte exportiert.</p><p>Für einzelne Berichte über die Wochenansicht gehen.</p>';
echo $this->Form->submit('Exportieren', array('id' => 'renose-print', 'data-link' => $this->Html->url(array('action' => 'export'))));
echo $this->Form->end();