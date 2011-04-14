<?php

class MenuItem extends AppModel
{
    var $name = 'MenuItem';
    //var $belongsTo = 'Menu';

    var $validate = array(
		'title' => array(
			'rule' => 'notEmpty'
		),
		'link' => array(
			'rule' => 'notEmpty'
		)
	);
}

?>