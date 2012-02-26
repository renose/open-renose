<h1><?php echo $this->eprint($this->getTitle); ?></h1>

    <?php echo html_entity_decode(viewPage::getSitebyID($_GET['name'], "value")); ?>
