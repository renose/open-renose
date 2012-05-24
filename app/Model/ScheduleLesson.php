<?php

App::uses('AppModel', 'Model');

class ScheduleLesson extends AppModel
{

    public $belongsTo = array(
        'Schedule' => array(
            'className' => 'Schedule',
            'foreignKey' => 'schedule_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        )
    );

}
