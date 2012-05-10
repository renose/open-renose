<?php
$a = $this->request->params['action'];
$c = $this->request->params['controller'];
?>
<ul class="nav">
    <li>
	<a href="<?= $this->Html->url('/', true); ?>" id="logo"><span>open</span>reNose</a>
    </li>
    <li <?= ($c == 'pages' && $a == 'view' && $this->request->params['pass'][0] != 'about') ? 'class="active"' : '' ?>>
	<?=
	$this->Html->link('Startseite', '/');
	?>
    </li>
    <li <?= ($c == 'pages' && $a == 'view' && $this->request->params['pass'][0] == 'about') ? 'class="active"' : '' ?>>
	<?=
	$this->Html->link('Über uns', array(
	    'controller' => 'pages',
	    'action' => 'view',
	    'about'
	));
	?>
    </li>
    <li <?= ($c == 'users' && $a == 'register') ? 'class="active"' : '' ?>>
<?=
$this->Html->link('Registrieren', array(
    'controller' => 'users',
    'action' => 'register'
));
?>
    </li>
</ul>