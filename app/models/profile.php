<?php
class Profile extends AppModel {
	var $name = 'Profile';
	/*var $displayField = 'full_name';

        var $virtualFields = array(
            'full_name' => "CONCAT(Profile.first_name, ' ', Profile.last_name)");*/

        var $belongsTo = 'Job';
}
?>