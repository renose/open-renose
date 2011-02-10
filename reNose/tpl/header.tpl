<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
	<title><?php echo $this->eprint($this->title); ?></title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<link rel="stylesheet" type="text/css" href="<?php echo $this->eprint(BASE_URL); ?>/tpl/files/style.css" />
	<script type="text/javascript" src="<?php echo $this->eprint(BASE_URL); ?>/system/core/cms/ckeditor/ckeditor.js"></script>
    </head>
    <body>
	<div id="container">
	<div id="wrapper">
	    <div id="header">
		<a href="<?php echo $this->eprint(BASE_URL); ?>"><h1 id="logo"><span>open</span>reNose</h1></a>
		<div id="headerinfo">
		    <?php echo $this->eprint($this->anredeLoggedIn); ?> <strong>Gast</strong>. Bitte registrieren oder einloggen.
		</div>
	    </div>

	    <div id="navigation">
		<ul>
		    <?php foreach ($this->navigation as $key => $navi): ?>
    		    <li><a href="<?php $this->eprint(BASE_URL . '/' . $navi['link']); ?>">
			    <?php $this->eprint($navi['text']); ?>
			</a>
		    </li>
		    <?php endforeach; ?>
		</ul>
	    </div>
	    <div id="content">
		<p class="breadcrumb"><a href="<?php echo $this->eprint(BASE_URL); ?>">Home</a> &raquo; Seiten &raquo; Bearbeiten (ID 4)</p>