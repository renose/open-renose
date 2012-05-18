<?php

App::uses('AppController', 'Controller');

class SchedulesController extends AppController
{
    
    public function index()
    {
        $schedule = $this->Schedule->find('first');
        $this->set('schedule', $schedule);
    }

    /**
     * view method
     *
     * @param string $id
     * @return void
     */
    public function view($id = null)
    {
        $this->Schedule->id = $id;
        if (!$this->Schedule->exists())
        {
            throw new NotFoundException(__('Invalid schedule'));
        }
        $this->set('schedule', $this->Schedule->read(null, $id));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add()
    {
        if ($this->request->is('post'))
        {
            $this->Schedule->create();
            if ($this->Schedule->save($this->request->data))
            {
                $this->Session->setFlash(__('The schedule has been saved'));
                $this->redirect(array('action' => 'index'));
            }
            else
            {
                $this->Session->setFlash(__('The schedule could not be saved. Please, try again.'));
            }
        }
        $users = $this->Schedule->User->find('list');
        $this->set(compact('users'));
    }

    /**
     * edit method
     *
     * @param string $id
     * @return void
     */
    public function edit($id = null)
    {
        $this->Schedule->id = $id;
        if (!$this->Schedule->exists())
        {
            throw new NotFoundException(__('Invalid schedule'));
        }
        if ($this->request->is('post') || $this->request->is('put'))
        {
            if ($this->Schedule->save($this->request->data))
            {
                $this->Session->setFlash(__('The schedule has been saved'));
                $this->redirect(array('action' => 'index'));
            }
            else
            {
                $this->Session->setFlash(__('The schedule could not be saved. Please, try again.'));
            }
        }
        else
        {
            $this->request->data = $this->Schedule->read(null, $id);
        }
        $users = $this->Schedule->User->find('list');
        $this->set(compact('users'));
    }

    /**
     * delete method
     *
     * @param string $id
     * @return void
     */
    public function delete($id = null)
    {
        if (!$this->request->is('post'))
        {
            throw new MethodNotAllowedException();
        }
        $this->Schedule->id = $id;
        if (!$this->Schedule->exists())
        {
            throw new NotFoundException(__('Invalid schedule'));
        }
        if ($this->Schedule->delete())
        {
            $this->Session->setFlash(__('Schedule deleted'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('Schedule was not deleted'));
        $this->redirect(array('action' => 'index'));
    }

}
