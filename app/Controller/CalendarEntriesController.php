<?php
App::uses('AppController', 'Controller');
/**
 * CalendarEntries Controller
 *
 * @property CalendarEntry $CalendarEntry
 */
class CalendarEntriesController extends AppController {


/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->CalendarEntry->recursive = 0;
		$this->set('calendarEntries', $this->paginate());
	}

/**
 * view method
 *
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->CalendarEntry->id = $id;
		if (!$this->CalendarEntry->exists()) {
			throw new NotFoundException(__('Invalid calendar entry'));
		}
		$this->set('calendarEntry', $this->CalendarEntry->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->CalendarEntry->create();
			if ($this->CalendarEntry->save($this->request->data)) {
				$this->Session->setFlash(__('The calendar entry has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The calendar entry could not be saved. Please, try again.'));
			}
		}
	}

/**
 * edit method
 *
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->CalendarEntry->id = $id;
		if (!$this->CalendarEntry->exists()) {
			throw new NotFoundException(__('Invalid calendar entry'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->CalendarEntry->save($this->request->data)) {
				$this->Session->setFlash(__('The calendar entry has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The calendar entry could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->CalendarEntry->read(null, $id);
		}
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
		$this->CalendarEntry->id = $id;
		if (!$this->CalendarEntry->exists()) {
			throw new NotFoundException(__('Invalid calendar entry'));
		}
		if ($this->CalendarEntry->delete()) {
			$this->Session->setFlash(__('Calendar entry deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Calendar entry was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
