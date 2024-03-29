<?php

App::uses('AppController', 'Controller');

/**
 * Attachments Controller
 *
 * @property Attachment $Attachment
 * @property PaginatorComponent $Paginator
 */
class AttachmentsController extends AppController {

    /**
     * Components
     *
     * @var array
     */
    public $components = array('Paginator');

    /**
     * index method
     *
     * @return void
     */
    public function index() {
        $this->Attachment->recursive = 0;
        $this->set('attachments', $this->Paginator->paginate());
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        if (!$this->Attachment->exists($id)) {
            throw new NotFoundException(__('Invalid attachment'));
        }
        $options = array('conditions' => array('Attachment.' . $this->Attachment->primaryKey => $id));
        $this->set('attachment', $this->Attachment->find('first', $options));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        if ($this->request->is('post')) {
            $this->Attachment->create();
            if ($this->Attachment->save($this->request->data)) {
                $this->Session->setFlash(__('The attachment has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The attachment could not be saved. Please, try again.'));
            }
        }
        $quyetDinhKiemNhiems = $this->Attachment->QuyetDinhKiemNhiem->find('list');
        $this->set(compact('quyetDinhKiemNhiems'));
    }

    /**
     * edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function edit($id = null) {
        if (!$this->Attachment->exists($id)) {
            throw new NotFoundException(__('Invalid attachment'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->Attachment->save($this->request->data)) {
                $this->Session->setFlash(__('The attachment has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The attachment could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('Attachment.' . $this->Attachment->primaryKey => $id));
            $this->request->data = $this->Attachment->find('first', $options);
        }
        $quyetDinhKiemNhiems = $this->Attachment->QuyetDinhKiemNhiem->find('list');
        $this->set(compact('quyetDinhKiemNhiems'));
    }

    /**
     * delete method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function delete($id = null) {
        $this->Attachment->id = $id;
        if (!$this->Attachment->exists()) {
            throw new NotFoundException(__('Invalid attachment'));
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->Attachment->delete()) {
            $this->Session->setFlash('Đã xóa đính kèm', 'Flash/flash_good');
        } else {
            $this->Session->setFlash('Xóa đính kèm không thành công', 'Flash/flash_bad');
        }
        return $this->redirect($this->referer());
    }

    

}
