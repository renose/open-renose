<?php
    $this->Html->addCrumb('Main');
    $this->Html->addCrumb('Profil', array('action' =>'view'));
?>
<h1>
    <?php echo $this->Html->image('icons/user.png'); ?>
    Profil
</h1>
<br/>

<style type="text/css">
    .clear {
        clear: both;
    }
    .input-group div.input {
        float: left;
        width: 250px;
        height: 50px;
    }
    
    .input-group div.input input{
        float: left;
        width: 200px;
    }
</style>

<div class="input-group">
    <?= $this->Editfield->inputfield('Vorname', 'first_name', $profile['Profile']['id'], $profile['Profile']['first_name'], array('required' => true)) ?>
    <?= $this->Editfield->inputfield('Nachname', 'last_name', $profile['Profile']['id'], $profile['Profile']['last_name'], array('required' => true)) ?>
</div>
<div class="clear"></div>

<div class="input-group">
    <?= $this->Editfield->inputfield('Geburtstag', 'birthday', $profile['Profile']['id'], $profile['Profile']['birthday'], array('type' => 'date')) ?>
    <?= $this->Editfield->inputfield('Geburtsort', 'birthplace', $profile['Profile']['id'], $profile['Profile']['birthplace']) ?>
</div>
<div class="clear"></div>
<br/>

<div class="input-group">
    <?= $this->Editfield->inputfield('PLZ', 'zip_code', $profile['Profile']['id'], $profile['Profile']['zip_code'], array('type' => 'number')) ?>
    <?= $this->Editfield->inputfield('Ort', 'city', $profile['Profile']['id'], $profile['Profile']['city']) ?>
    <div class="clear"></div>
    
    <?= $this->Editfield->inputfield('Straße', 'street', $profile['Profile']['id'], $profile['Profile']['street']) ?>
</div>
<div class="clear"></div>
<br/>

<div class="input-group">
    <?= $this->Editfield->inputfield('Beruf', 'job_name', $profile['Profile']['id'], $profile['Job']['name']) ?>
    <div class="clear"></div>
    
    <?= $this->Editfield->inputfield('Ausbildungsfirma', 'company', $profile['Profile']['id'], $profile['Profile']['company']) ?>
    <?= $this->Editfield->inputfield('Geschäftszweig', 'branch', $profile['Profile']['id'], $profile['Profile']['branch']) ?>
</div>
<div class="clear"></div>
<br/>

<?= $this->Editfield->inputfield('Vertragliche Ausbildungszeit von', 'start_training_period', $profile['Profile']['id'], $profile['Profile']['start_training_period'], array('type' => 'date', 'required' => true)) ?>
<?= $this->Editfield->inputfield('bis', 'end_training_period', $profile['Profile']['id'], $profile['Profile']['end_training_period'], array('type' => 'date', 'required' => true)) ?>
<br/>

<?= $this->Editfield->inputfield('Vertrag abgeschlossen am', 'date', $profile['Profile']['id'], $profile['Profile']['birthday'], array('type' => 'date')) ?>
<?= $this->Editfield->inputfield('Eingetragen ins Verzeichnis der Berufsausbildungsregister', 'date', $profile['Profile']['id'], $profile['Profile']['birthday'], array('type' => 'date')) ?>
<br/>

<div class="input-group">
    <?= $this->Editfield->inputfield('Zuständige IHK', 'assigned_board_of_trade', $profile['Profile']['id'], $profile['Profile']['assigned_board_of_trade']) ?>
</div>
<div class="clear"></div>
<br/>

Kurzbericht über Schulbildung und vorangegangene berufliche Tätigkeiten vor Antritt der Ausbildung:
<?= $this->Editfield->editbox('past', $profile['Profile']['id'], $profile['Profile']['past']) ?>


<script type="text/javascript">
    $('.inputfield').inputfield('<?php echo $this->Html->url(array('action' => 'save')); ?>');
    $('.editbox').editbox('<?php echo $this->Html->url(array('action' => 'save')); ?>');
    
    var availableTags = [
        "<?php echo implode('", "', $jobs); ?>"
    ];
    $( "#inputfield-job_name" ).autocomplete({
        source: availableTags
    });
</script>

<?php pr($jobs); ?>