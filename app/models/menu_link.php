<?php

class MenuLink extends AppModel
{
    var $name = 'MenuLink';

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