<?php

class Page extends AppModel
{
    var $name = 'Page';
    
    var $validate = array(
		'title' => array(
			'rule' => 'notEmpty'
		),
		'description' => array(
			'rule' => 'notEmpty'
		),
		'body' => array(
			'rule' => 'notEmpty'
		)
	);
}

?>