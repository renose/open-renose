<?php
App::uses('AppModel', 'Model');

class WeeklyReport extends AppModel {

	public $hasMany = array('WeeklyReportSchoolEntry');

}
