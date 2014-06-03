<?php

App::uses('AppController', 'Controller');

/**
 * Departments Controller
 *
 * @property Department $Department
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class DepartmentsController extends AppController {

    /**
     * Components
     *
     * @var array
     */
    public $components = array('Paginator', 'Session');

    /**
     * index method
     *
     * @return void
     */
    public function index() {
        $this->Department->recursive = 0;
        $this->set('departments', $this->Paginator->paginate());
        $data = $this->Department->generateTreeList();
        debug($data);
        die;
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        if (!$this->Department->exists($id)) {
            throw new NotFoundException(__('Invalid department'));
        }
        $options = array('conditions' => array('Department.' . $this->Department->primaryKey => $id));
        $this->set('department', $this->Department->find('first', $options));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        if ($this->request->is('post')) {
            $this->Department->create();
            if ($this->Department->save($this->request->data)) {
                $this->Session->setFlash(__('The department has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The department could not be saved. Please, try again.'));
            }
        }
        $parentDepartments = $this->Department->ParentDepartment->find('list');
        $this->set(compact('parentDepartments'));
    }

    /**
     * edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function edit($id = null) {
        if (!$this->Department->exists($id)) {
            throw new NotFoundException(__('Invalid department'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->Department->save($this->request->data)) {
                $this->Session->setFlash(__('The department has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The department could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('Department.' . $this->Department->primaryKey => $id));
            $this->request->data = $this->Department->find('first', $options);
        }
        $parentDepartments = $this->Department->ParentDepartment->find('list');
        $this->set(compact('parentDepartments'));
    }

    /**
     * delete method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function delete($id = null) {
        $this->Department->id = $id;
        if (!$this->Department->exists()) {
            throw new NotFoundException(__('Invalid department'));
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->Department->delete()) {
            $this->Session->setFlash(__('The department has been deleted.'));
        } else {
            $this->Session->setFlash(__('The department could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'index'));
    }

}
