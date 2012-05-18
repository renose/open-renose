<?php
App::uses('AppController', 'Controller');
/**
 * ScheduleLessons Controller
 *
 * @property ScheduleLesson $ScheduleLesson
 */
class ScheduleLessonsController extends AppController {


/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->ScheduleLesson->recursive = 0;
		$this->set('scheduleLessons', $this->paginate());
	}

/**
 * view method
 *
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->ScheduleLesson->id = $id;
		if (!$this->ScheduleLesson->exists()) {
			throw new NotFoundException(__('Invalid schedule lesson'));
		}
		$this->set('scheduleLesson', $this->ScheduleLesson->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->ScheduleLesson->create();
			if ($this->ScheduleLesson->save($this->request->data)) {
				$this->Session->setFlash(__('The schedule lesson has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The schedule lesson could not be saved. Please, try again.'));
			}
		}
		$schedules = $this->ScheduleLesson->Schedule->find('list');
		$this->set(compact('schedules'));
	}

/**
 * edit method
 *
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->ScheduleLesson->id = $id;
		if (!$this->ScheduleLesson->exists()) {
			throw new NotFoundException(__('Invalid schedule lesson'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->ScheduleLesson->save($this->request->data)) {
				$this->Session->setFlash(__('The schedule lesson has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The schedule lesson could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->ScheduleLesson->read(null, $id);
		}
		$schedules = $this->ScheduleLesson->Schedule->find('list');
		$this->set(compact('schedules'));
	}

/**
 * delete method
 *
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->ScheduleLesson->id = $id;
		if (!$this->ScheduleLesson->exists()) {
			throw new NotFoundException(__('Invalid schedule lesson'));
		}
		if ($this->ScheduleLesson->delete()) {
			$this->Session->setFlash(__('Schedule lesson deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Schedule lesson was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
