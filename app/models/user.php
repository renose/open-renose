<?php
class User extends AppModel {
	var $name = 'User';
	var $displayField = 'email';
	var $validate = array(
		'email' => array( 'rule' =>'email' ),
		'password' => array( 'rule' =>'notempty' ) );

        var $hasOne = array(
            'Profile' => array(
                'dependent' => true
                )
            );
}
?>