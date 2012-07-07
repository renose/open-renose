<?php
App::uses('AppModel', 'Model');

class WeeklyReportSchoolEntry extends AppModel {

	public $belongsTo = array('WeeklyReport');

}
