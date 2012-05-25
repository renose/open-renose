<?php
/* ReportSchool Test cases generated on: 2012-05-25 11:10:48 : 1337937048*/
App::uses('ReportSchool', 'Model');

/**
 * ReportSchool Test Case
 *
 */
class ReportSchoolTestCase extends CakeTestCase {
/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array('app.report_school', 'app.report', 'app.user', 'app.profile', 'app.job', 'app.profiles', 'app.schedule', 'app.schedule_lesson', 'app.calender_entry', 'app.report_activity', 'app.report_instruction');

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();

		$this->ReportSchool = ClassRegistry::init('ReportSchool');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->ReportSchool);

		parent::tearDown();
	}

}
