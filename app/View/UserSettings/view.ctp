<?php
    $this->Html->addCrumb('Main');
    $this->Html->addCrumb('Einstellungen', array('action' =>'view'));
?>
<h1>
    <?php echo $this->Html->image('icons/settings.png'); ?>
    Einstellungen
</h1>
<br/>

Berichtstyp:
<?= $settings['UserSetting']['report_type']; ?>

<?php
pr($settings);