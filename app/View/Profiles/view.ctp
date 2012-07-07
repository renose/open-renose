<?php
    $this->Html->addCrumb('Main');
    $this->Html->addCrumb('Profil', array('action' =>'index'));
?>
<h1>
    <?php echo $this->Html->image('icons/user.png'); ?>
    Profil
</h1>
<br/>

<b>Vorname:</b>
<?= $this->element('report/editfield', array('id' => $profile['Profile']['id'], 'field' => 'first_name', 'data' => $profile['Profile']['first_name'])) ?>
<b>Nachname:</b>
<?= $this->element('report/editfield', array('id' => $profile['Profile']['id'], 'field' => 'last_name', 'data' => $profile['Profile']['last_name'])) ?>
<br/>

<b>Beruf:</b>
<?= $this->element('report/editfield', array('id' => $profile['Profile']['id'], 'field' => 'job_name', 'data' => $profile['Job']['name'])) ?>
<br/>

<b>Straße:</b>
<?= $this->element('report/editfield', array('id' => $profile['Profile']['id'], 'field' => 'street', 'data' => $profile['Profile']['street'])) ?>
<b>Postleitzahl:</b>
<?= $this->element('report/editfield', array('id' => $profile['Profile']['id'], 'field' => 'zip_code', 'data' => $profile['Profile']['zip_code'])) ?>
<b>Stadt:</b>
<?= $this->element('report/editfield', array('id' => $profile['Profile']['id'], 'field' => 'city', 'data' => $profile['Profile']['city'])) ?>
<br/>

<b>Geburtstag:</b>
<?= $this->element('report/inputfield', array('id' => $profile['Profile']['id'], 'type' => 'date', 'field' => 'birthday', 'data' => $profile['Profile']['birthday'])) ?>
<br/>
<b>Geburtsort:</b>
<?= $this->element('report/editfield', array('id' => $profile['Profile']['id'], 'field' => 'birthplace', 'data' => $profile['Profile']['birthplace'])) ?>
<br/>

<b>Ausbildungsfirma:</b>
<?= $this->element('report/editfield', array('id' => $profile['Profile']['id'], 'field' => 'company', 'data' => $profile['Profile']['company'])) ?>
<b>Geschäftszweig:</b>
<?= $this->element('report/editfield', array('id' => $profile['Profile']['id'], 'field' => 'branch', 'data' => $profile['Profile']['branch'])) ?>
<br/>

<b>Vertragliche Ausbildungszeit von:</b>
<?= $this->element('report/inputfield', array('id' => $profile['Profile']['id'], 'type' => 'date', 'field' => 'start_training_period', 'data' => $profile['Profile']['start_training_period'])) ?>
<b>bis:</b>
<?= $this->element('report/inputfield', array('id' => $profile['Profile']['id'], 'type' => 'date', 'field' => 'end_training_period', 'data' => $profile['Profile']['end_training_period'])) ?>
<br/>

<b>Vertrag abgeschlossen am:</b>
<?= $this->element('report/inputfield', array('id' => $profile['Profile']['id'], 'type' => 'date', 'field' => 'contract_signed', 'data' => $profile['Profile']['contract_signed'])) ?>
<b>Eingetragen ins Verzeichnis der Berufsausbildungsregister:</b>
<?= $this->element('report/inputfield', array('id' => $profile['Profile']['id'], 'type' => 'date', 'field' => 'contract_registered', 'data' => $profile['Profile']['contract_registered'])) ?>
<br/><br/>

<b>Zuständige IHK, z.B. 'Region Stuttgart':</b>
<?= $this->element('report/editfield', array('id' => $profile['Profile']['id'], 'field' => 'assigned_board_of_trade', 'data' => $profile['Profile']['assigned_board_of_trade'])) ?>
<br/>

<b>Kurzbericht über Schulbildung und vorangegangene berufliche Tätigkeiten vor Antritt der Ausbildung:</b>
<?= $this->element('report/editfield', array('id' => $profile['Profile']['id'], 'field' => 'past', 'data' => $profile['Profile']['past'])) ?>


<script type="text/javascript">
    $('.editfield').editfield('<?php echo $this->Html->url(array('action' => 'save')); ?>');
    
    var availableTags = [
        "<?php echo implode('", "', $jobs); ?>"
    ];
    $( "#ProfileJobName" ).autocomplete({
        source: availableTags
    });
</script>

<?php pr($jobs); ?>