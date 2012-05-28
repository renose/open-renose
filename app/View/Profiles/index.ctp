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

echo $this->Form->input('birthday', array('label' => 'Geburtstag', 'dateFormat' => 'DMY', 'minYear' => date('Y') -70 ,'maxYear' => date('Y')));
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
