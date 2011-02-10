<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
  <head>
    <title><?php echo $this->eprint($this->title); ?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <link rel="stylesheet" type="text/css" href="<?php echo $this->eprint(BASE_URL); ?>/tpl/files/style.css" />
    <script type="text/javascript" src="<?php echo $this->eprint(BASE_URL); ?>/system/core/cms/ckeditor/ckeditor.js"></script>
  </head>
  <body>
      <div id="nonfooter">
      <div id="header">
          <div class="center"><a href="<?php echo $this->eprint(BASE_URL); ?>/index.php"><img src="<?php echo $this->eprint(BASE_URL); ?>/tpl/files/images/logo_hq.png" alt="" title="<?php echo $this->eprint($this->title); ?>" /></a>
              <p>Willkommen zurück, <strong>Foo Bar!</strong> Es gibt 3 <a href="#">Neuigkeiten</a>.
              <ul>
              	<?php foreach ($this->navigation as $key => $navi): ?>
					<li>
						<a href="<?php $this->eprint(BASE_URL . '/' . $navi['link']); ?>">
							<?php $this->eprint($navi['text']); ?>
						</a>
					</li>
				<?php endforeach; ?>
              </ul>
          </div>
      </div>
      <div class="center" id="content">