<?php

echo $this->Form->create('User', array(
	'action' => 'login',
	'class' => 'form-inline navbar-search pull-right',
	'inputDefaults' => array(
	    'div' => false,
	    'error' => false
	    )
	));

echo $this->Html->image('icons_white/login.png', array('class' => 'login-icon'));

    echo $this->Form->input('email', array(
	'class' => 'input-medium',
	'label' => false,
	'placeholder' => 'E-Mail')
    );
echo ' ';
    echo $this->Form->input('password', array(
	'class' => 'input-small',
	'label' => false,
	'placeholder' => 'Passwort')
    );
echo ' ';
    echo $this->Form->button('Einloggen', array('class' => 'btn btn-inverse btn-mini'));
echo ' ';
    echo $this->Html->link('Passwort vergessen?', array(
	'controller' => 'users',
	'action'  => 'forgot',
	),
	array(
	    'id' => 'navigation-forgot-password'
	)
    );

    echo $this->Form->end();
    ?>