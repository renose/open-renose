<?php
/* ReportSchools Test cases generated on: 2012-05-25 11:10:48 : 1337937048*/
App::uses('ReportSchoolsController', 'Controller');

/**
 * TestReportSchoolsController *
 */
class TestReportSchoolsController extends ReportSchoolsController {
/**
 * Auto render
 *
 * @var boolean
 */
	public $autoRender = false;

/**
 * Redirect action
 *
 * @param mixed $url
 * @param mixed $status
 * @param boolean $exit
 * @return void
 */
	public function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

/**
 * ReportSchoolsController Test Case
 *
 */
class ReportSchoolsControllerTestCase extends CakeTestCase {
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

		$this->ReportSchools = new TestReportSchoolsController();
		$this->ReportSchools->constructClasses();
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->ReportSchools);

		parent::tearDown();
	}

/**
 * testIndex method
 *
 * @return void
 */
	public function testIndex() {

	}

/**
 * testView method
 *
 * @return void
 */
	public function testView() {

	}

/**
 * testAdd method
 *
 * @return void
 */
	public function testAdd() {

	}

/**
 * testEdit method
 *
 * @return void
 */
	public function testEdit() {

	}

/**
 * testDelete method
 *
 * @return void
 */
	public function testDelete() {

	}

}
