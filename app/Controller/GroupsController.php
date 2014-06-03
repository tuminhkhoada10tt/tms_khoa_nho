<?php

App::uses('AppController', 'Controller');

/**
 * Groups Controller
 *
 * @property Group $Group
 * @property PaginatorComponent $Paginator
 */
class GroupsController extends AppController {

    /*public function beforeFilter() {
        parent::beforeFilter();
        if ($this->Acl->check(array('User' => array('id' => $this->Auth->user('id'))), $this->action)) {

            $this->Acl->allow(array('User' => array('id' => $this->Auth->user('id'))), $this->action);
        } else {
            $this->Session->setFlash('Bạn không có quyền truy cập');
            $this->redirect('/');
        }
    }*/

    /**
     * index method
     *
     * @return void
     */
    public function index() {
        $this->Group->recursive = 0;
        $this->set('groups', $this->Paginator->paginate());
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        if (!$this->Group->exists($id)) {
            throw new NotFoundException(__('Invalid group'));
        }
        $options = array('conditions' => array('Group.' . $this->Group->primaryKey => $id));
        $this->set('group', $this->Group->find('first', $options));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        if ($this->request->is('post')) {
            $this->Group->create();
            if ($this->Group->save($this->request->data)) {
                $this->Session->setFlash(__('The group has been saved.'));
                $this->redirect(array('action' => 'index'));
                
            }
        }
        $users = $this->Group->User->find('list');
        $this->set(compact('users'));
    }

    /**
     * edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function edit($id = null) {
        if (!$this->Group->exists($id)) {
            throw new NotFoundException(__('Invalid group'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->Group->save($this->request->data)) {
                $this->Session->setFlash(__('The group has been saved.'));
                $this->redirect(array('action' => 'index'));
            }
        } else {
            $options = array('conditions' => array('Group.' . $this->Group->primaryKey => $id));
            $this->request->data = $this->Group->find('first', $options);
        }
        $users = $this->Group->User->find('list');
        $this->set(compact('users'));
    }

    /**
     * delete method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function delete($id = null) {
        $this->Group->id = $id;
        if (!$this->Group->exists()) {
            throw new NotFoundException(__('Invalid group'));
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->Group->delete()) {
            return $this->flash(__('The group has been deleted.'), array('action' => 'index'));
        } else {
            return $this->flash(__('The group could not be deleted. Please, try again.'), array('action' => 'index'));
        }
    }

}
