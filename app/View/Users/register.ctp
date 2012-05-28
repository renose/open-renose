<?php
$this->Html->addCrumb('User');
$this->Html->addCrumb('Registrieren', array('action' => 'register'));
?>
<h1 class="frontpage-headline">
    <?php echo $this->Html->image('icons/key.png'); ?>
    Registrieren
</h1>

<?php
    echo $this->Form->create('User', array(
	'action' => 'register',
	'inputDefaults' => array(
	    'div' => 'control-group',
	    'error' => array('attributes' => array('wrap' => 'span', 'class' => 'help-inline'))
	    )
	));

    echo $this->Form->input('email');

    echo $this->Form->input('password', array('type' => 'password', 'label' => 'Passwort'));
    echo $this->Form->input('password_confirm', array('type' => 'password', 'label' => 'Passwort bestätigen'));

    /*echo $ajax->submit('Submit',
            array(
                'url'=> array('controller'=>'users', 'action'=>'register'),
                'update' => 'testdiv'));
    echo $this->Form->end();*/
    echo $this->Form->end('Registrieren');
