<?php

class Menu extends AppModel
{
    var $name = 'Menu';
    //var $hasMany = 'MenuItem';
    var $hasMany = array(
        'MenuItem' => array(
            'order' => 'MenuItem.position ASC') );


    var $validate = array(
		'title' => array(
			'rule' => 'notEmpty'
		),
		'description' => array(
			'rule' => 'notEmpty'
		)
	);
}

?>