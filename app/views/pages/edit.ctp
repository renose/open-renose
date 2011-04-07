<?php 
	echo $javascript->link('ckeditor/ckeditor', NULL, false); 
?> 

<h1>Edit Page</h1>
<?php
echo $form->create('Page');
echo $form->input('title');
echo $form->input('description');

echo $form->input('body', array('rows' => '3'));
echo $fck->load('Page.body'); 

echo $form->end('Save Page');
?>