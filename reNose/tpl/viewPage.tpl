<h1><?php echo $this->eprint($this->getTitle); ?></h1>

    <?php echo htmlspecialchars_decode(viewPage::getSitebyID($_GET['id'], "value")); ?>
