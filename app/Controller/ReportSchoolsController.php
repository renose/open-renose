<?php
App::uses('AppController', 'Controller');
/**
 * ReportSchools Controller
 *
 * @property ReportSchool $ReportSchool
 */
class ReportSchoolsController extends AppController {


/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->ReportSchool->recursive = 0;
		$this->set('reportSchools', $this->paginate());
	}

/**
 * view method
 *
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->ReportSchool->id = $id;
		if (!$this->ReportSchool->exists()) {
			throw new NotFoundException(__('Invalid report school'));
		}
		$this->set('reportSchool', $this->ReportSchool->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->ReportSchool->create();
			if ($this->ReportSchool->save($this->request->data)) {
				$this->Session->setFlash(__('The report school has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The report school could not be saved. Please, try again.'));
			}
		}
		$reports = $this->ReportSchool->Report->find('list');
		$this->set(compact('reports'));
	}

/**
 * edit method
 *
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->ReportSchool->id = $id;
		if (!$this->ReportSchool->exists()) {
			throw new NotFoundException(__('Invalid report school'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->ReportSchool->save($this->request->data)) {
				$this->Session->setFlash(__('The report school has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The report school could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->ReportSchool->read(null, $id);
		}
		$reports = $this->ReportSchool->Report->find('list');
		$this->set(compact('reports'));
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
		$this->ReportSchool->id = $id;
		if (!$this->ReportSchool->exists()) {
			throw new NotFoundException(__('Invalid report school'));
		}
		if ($this->ReportSchool->delete()) {
			$this->Session->setFlash(__('Report school deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Report school was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
