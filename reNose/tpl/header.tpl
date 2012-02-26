<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
  <head>
    <title><?php echo $this->eprint($this->title); ?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <link rel="stylesheet" type="text/css" href="<?php echo $this->eprint(BASE_URL); ?>/tpl/files/style.css" />
  </head>
  <body>
      <div id="nonfooter">
      <div id="header">
          <div class="center"><a href="<?php $_SERVER['PHP_SELF'] ?>"><img src="tpl/files/images/logo_hq.png" alt="" title="<?php echo $this->eprint($this->title); ?>" /></a>
              <p>Willkommen zurück, <strong>Foo Bar!</strong> Es gibt 3 <a href="#">Neuigkeiten</a>.
              <ul>
                  <li><a href="#">Home</a></li>
                  <li><a href="#">Über das Projekt</a></li>
                  <li><a href="#">FAQ</a></li>
                  <li><a href="#">Hilfe</a></li>
                  <li><a href="#">Ausloggen</a></li>
              </ul>
          </div>
      </div>