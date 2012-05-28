<?php
$this->Html->addCrumb('User');
$this->Html->addCrumb('Login', array('action' => 'login'));
?>
<h1 class="frontpage-headline">
    <?php echo $this->Html->image('icons/login.png'); ?>
    Login
</h1>

<?php
    echo $this->Form->create('User', array(
	'action' => 'login',
	'inputDefaults' => array(
	    'div' => 'control-group',
	    'error' => array('attributes' => array('wrap' => 'span', 'class' => 'help-inline'))
	    )
	));

    echo $this->Form->input('email');
    echo $this->Form->input('password');

    echo $this->Form->end('Login');
