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
    <?= $this->element('editfields/inputfield', array('id' => $profile['Profile']['id'], 'name' => 'Vorname', 'field' => 'first_name', 'data' => $profile['Profile']['first_name'])) ?>
    <?= $this->element('editfields/inputfield', array('id' => $profile['Profile']['id'], 'name' => 'Nachname', 'field' => 'last_name', 'data' => $profile['Profile']['last_name'])) ?>
</div>
<div class="clear"></div>

<div class="input-group">
    <?= $this->element('editfields/inputfield', array('id' => $profile['Profile']['id'], 'type' => 'date', 'name' => 'Geburtstag', 'field' => 'birthday', 'data' => $profile['Profile']['birthday'])) ?>
    <?= $this->element('editfields/inputfield', array('id' => $profile['Profile']['id'], 'name' => 'Geburtsort', 'field' => 'birthplace', 'data' => $profile['Profile']['birthplace'])) ?>
</div>
<div class="clear"></div>
<br/>

<div class="input-group">
    <?= $this->element('editfields/inputfield', array('id' => $profile['Profile']['id'], 'type' => 'number', 'name' => 'PLZ', 'field' => 'zip_code', 'data' => $profile['Profile']['zip_code'])) ?>
    <?= $this->element('editfields/inputfield', array('id' => $profile['Profile']['id'], 'name' => 'Ort', 'field' => 'city', 'data' => $profile['Profile']['city'])) ?>
    <div class="clear"></div>
    
    <?= $this->element('editfields/inputfield', array('id' => $profile['Profile']['id'], 'name' => 'Straße', 'field' => 'street', 'data' => $profile['Profile']['street'])) ?>
</div>
<div class="clear"></div>
<br/>

<div class="input-group">
    <?= $this->element('editfields/inputfield', array('id' => $profile['Profile']['id'], 'name' => 'Beruf', 'field' => 'job_name', 'data' => $profile['Job']['name'])) ?>
    <div class="clear"></div>
    
    <?= $this->element('editfields/inputfield', array('id' => $profile['Profile']['id'], 'name' => 'Ausbildungsfirma', 'field' => 'company', 'data' => $profile['Profile']['company'])) ?>
    <?= $this->element('editfields/inputfield', array('id' => $profile['Profile']['id'], 'name' => 'Geschäftszweig', 'field' => 'branch', 'data' => $profile['Profile']['branch'])) ?>
</div>
<div class="clear"></div>
<br/>

Vertragliche Ausbildungszeit von:
<?= $this->element('editfields/inputfield', array('id' => $profile['Profile']['id'], 'type' => 'date', 'field' => 'start_training_period', 'data' => $profile['Profile']['start_training_period'])) ?>
bis:
<?= $this->element('editfields/inputfield', array('id' => $profile['Profile']['id'], 'type' => 'date', 'field' => 'end_training_period', 'data' => $profile['Profile']['end_training_period'])) ?>
<br/>

Vertrag abgeschlossen am:
<?= $this->element('editfields/inputfield', array('id' => $profile['Profile']['id'], 'type' => 'date', 'field' => 'contract_signed', 'data' => $profile['Profile']['contract_signed'])) ?>
Eingetragen ins Verzeichnis der Berufsausbildungsregister:
<?= $this->element('editfields/inputfield', array('id' => $profile['Profile']['id'], 'type' => 'date', 'field' => 'contract_registered', 'data' => $profile['Profile']['contract_registered'])) ?>
<br/>

<div class="input-group">
    <?= $this->element('editfields/inputfield', array('id' => $profile['Profile']['id'], 'name' => 'Zuständige IHK', 'field' => 'assigned_board_of_trade', 'data' => $profile['Profile']['assigned_board_of_trade'])) ?>
</div>
<div class="clear"></div>
<br/>

Kurzbericht über Schulbildung und vorangegangene berufliche Tätigkeiten vor Antritt der Ausbildung:
<div class="edit-container editbox" data-id="<?= $profile['Profile']['id'] ?>" data-field="past">
<?php if($profile['Profile']['past']) : ?>
    <div class="edit-textbox" data-exists="true"><?= $profile['Profile']['past'] ?></div>
<?php else: ?>
    <div class="edit-textbox" data-exists="false"></div>
<?php
    endif;
    echo $this->Html->image('icons/delete.png', array('class' => 'edit-delete', 'alt' => 'löschen'));
?>
    
    <div style="clear: both;"></div>
</div>


<script type="text/javascript">
    $('.editfield').editfield('<?php echo $this->Html->url(array('action' => 'save')); ?>');
    $('.inputfield').inputfield('<?php echo $this->Html->url(array('action' => 'save')); ?>');
    $('.editbox').editbox('<?php echo $this->Html->url(array('action' => 'save')); ?>');
    
    var availableTags = [
        "<?php echo implode('", "', $jobs); ?>"
    ];
    $( "#job_name" ).autocomplete({
        source: availableTags
    });
</script>

<?php pr($jobs); ?>