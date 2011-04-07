<h1>Add Page</h1>
<?php
echo $form->create('Page');
echo $form->input('title');
echo $form->input('description');
echo $form->input('body', array('rows' => '3'));
echo $form->end('Create Page');
?>