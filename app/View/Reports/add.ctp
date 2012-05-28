<?php
    $this->Html->addCrumb('Berichte');
    $this->Html->addCrumb('Übersicht', array('action' =>'display', $this->request->data['Report']['year']));
    $this->Html->addCrumb('Bericht erstellen');
?>

<h1><?php echo $title_for_layout; ?></h1>

<?php
    echo $this->Form->create('Report');

    echo $this->Form->input('date', array('label' => 'Datum der Unterschrift'));

    echo $this->Form->input('year', array('label' => 'Jahr', 'type' => 'text'));
    echo $this->Form->input('week', array('label' => 'Woche'));
    echo $this->Form->input('number', array('label' => 'Nummer'));

    echo $this->Form->end('Bericht erstellen');
?>