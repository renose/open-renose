<?php
    $this->Html->addCrumb('Main');
    $this->Html->addCrumb('Profil', array('action' =>'index'));
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
echo '<hr />';
echo $this->Form->input('street', array('label' => 'Straße'));

echo $this->Form->input('zip_code', array('label' => 'Postleitzahl'));
echo $this->Form->input('city', array('label' => 'Stadt'));

echo $this->Form->input('birthday', array('label' => 'Geburtstag', 'dateFormat' => 'DMY', 'minYear' => date('Y') -70 ,'maxYear' => date('Y')));
echo $this->Form->input('birthplace', array('label' => 'Geburtsort'));
echo '<hr />';
echo $this->Form->input('company', array('label' => 'Ausbildungsfirma'));
echo $this->Form->input('branch', array('label' => 'Geschäftszweig'));
echo '<hr />';
echo $this->Form->input('start_training_period', array('label' => 'Vertragliche Ausbildungszeit vom', 'dateFormat' => 'DMY', 'minYear' => date('Y') -5 ,'maxYear' => date('Y')));
echo $this->Form->input('end_training_period', array('label' => 'bis', 'dateFormat' => 'DMY', 'minYear' => date('Y') ,'maxYear' => date('Y')+5));
echo '<hr />';
echo $this->Form->input('contract_signed', array('label' => 'Vertrag abgeschlossen am', 'dateFormat' => 'DMY', 'minYear' => date('Y') -5 ,'maxYear' => date('Y')));
echo $this->Form->input('contract_registered', array('label' => 'Eingetragen ins Verzeichnis der Berufsausbildungsregister', 'dateFormat' => 'DMY', 'minYear' => date('Y') -5 ,'maxYear' => date('Y')));
echo $this->Form->input('assigned_board_of_trade', array('label' => 'Zuständige IHK, z.B. \'Region Stuttgart\''));

echo $this->Form->input('past', array('label' => 'Kurzbericht über Schulbildung und vorangegangene berufliche Tätigkeiten vor Antritt der Ausbildung'));


echo $this->Form->end('Speichern');
?>

<?php pr($jobs); 

pr($this->data);

?>

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
