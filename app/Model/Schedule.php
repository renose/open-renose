<?php

App::uses('AppModel', 'Model');

class Schedule extends AppModel
{

    public $belongsTo = array('User');
    public $hasMany = array(
        'ScheduleLesson' => array(
            'dependent' => true
        )
    );

}
