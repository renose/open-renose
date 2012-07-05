<?php
App::uses('AppModel', 'Model');

class ReportWeek extends AppModel {

	public $belongsTo = array('Report');
	public $hasMany = array('ReportWeekSchoolSubject');

}
