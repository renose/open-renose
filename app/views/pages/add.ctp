<?php  echo $javascript->link('ckeditor/ckeditor', NULL, false);  ?> 
<h1>
    <?php echo $title_for_layout; ?>
</h1>

<?php
    echo $form->create('Page');
    
    echo $form->input('title', array('label' => 'URL-Titel'));
    echo $form->input('description', array('label' => 'Überschrift'));

    echo $form->input('body', array('rows' => '5', 'label' => 'Inhalt'));
    echo $fck->load('Page.body');

    echo $form->end('Seite erstellen');
?>