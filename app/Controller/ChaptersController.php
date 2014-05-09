<?php

App::uses('AppController', 'Controller');

/**
 * Chapters Controller
 *
 * @property Chapter $Chapter
 * @property PaginatorComponent $Paginator
 */
class ChaptersController extends AppController {

    /**
     * Components
     *
     * @var array
     */
    public $components = array('Paginator', 'Session', 'TinymceElfinder.TinymceElfinder');
    public $helpers = array('TinymceElfinder.TinymceElfinder');

    /**
     * index method
     *
     * @return void
     */
    public function index() {
        $role = $this->Session->read('layout');
        return $this->redirect(array('action' => $role . "_index"));
    }

    public function search() {

        if ($this->request->is('ajax')) {
            // Use data from serialized form
            $chapter_name = $this->request->data['chapter_name'];
            $this->Paginator->settings = array(
                'conditions' => array(
                    'Chapter.created_user_id' => $this->Auth->user('id'),
                    'Chapter.name like ' => '%' . $chapter_name . '%'
            ));
            $this->set('chapters', $this->Paginator->paginate());
            $this->render('search_results', 'ajax'); // Render the contact-ajax-response view in the ajax layout
        }
    }

    public function fields_manager_index() {
        $contain = array('CreatedUser' => array('fields' => array('id', 'name')), 'Field');
        $this->Paginator->settings = array('conditions' => array('Chapter.created_user_id' => $this->Auth->user('id')), 'contain' => $contain);
        $this->set('chapters', $this->Paginator->paginate());
    }

    public function fields_manager_view($id) {
        if (!$this->Chapter->exists($id)) {
            throw new NotFoundException(__('Invalid chapter'));
        }
        $contain = array('CreatedUser' => array('fields' => array('id', 'name')), 'Field');
        $options = array('conditions' => array('Chapter.' . $this->Chapter->primaryKey => $id),'contain'=>$contain);
        $this->set('chapter', $this->Chapter->find('first', $options));
    }

    public function fields_manager_add() {
        if ($this->request->is('post')) {
            $this->Chapter->create();
            $this->request->data['Chapter']['created_user_id'] = $this->Auth->user('id');
            if ($this->Chapter->save($this->request->data)) {
                $this->Session->setFlash('Thêm chuyên đề thành công', 'alert', array('plugin' => 'BoostCake', 'class' => 'alert-success'));
                return $this->redirect(array('action' => 'index'));
            }
        }
        $fields = $this->Chapter->Field->find('list');
        $this->set(compact('fields'));
    }
    
    /*Teacher com*/

    public function teacher_view() {
        if (!$this->Chapter->exists($id)) {
            throw new NotFoundException(__('Invalid chapter'));
        }
        $contain = array('CreatedUser' => array('fields' => array('id', 'name')), 'Field');
        $options = array('conditions' => array('Chapter.' . $this->Chapter->primaryKey => $id),'contain'=>$contain);
        $this->set('chapter', $this->Chapter->find('first', $options));
    }


    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        if (!$this->Chapter->exists($id)) {
            throw new NotFoundException(__('Invalid chapter'));
        }
        $contain = array('CreatedUser' => array('fields' => array('id', 'name')), 'Field');
        $options = array('conditions' => array('Chapter.' . $this->Chapter->primaryKey => $id),'contain'=>$contain);
        $this->set('chapter', $this->Chapter->find('first', $options));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        if ($this->request->is('post')) {
            $this->Chapter->create();
            $this->request->data['Chapter']['created_user_id'] = $this->Auth->user('id');
            if ($this->Chapter->save($this->request->data)) {
                $this->Session->setFlash('Thêm chuyên đề thành công', 'alert', array('plugin' => 'BoostCake', 'class' => 'alert-success'));
                return $this->redirect(array('action' => 'index'));
            }
        }
        $fields = $this->Chapter->Field->find('list');
        $this->set(compact('fields'));
    }

    /**
     * edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function edit($id = null) {
        if (!$this->Chapter->exists($id)) {
            throw new NotFoundException(__('Invalid chapter'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->Chapter->save($this->request->data)) {
                return $this->flash(__('The chapter has been saved.'), array('action' => 'index'));
            }
        } else {
            $options = array('conditions' => array('Chapter.' . $this->Chapter->primaryKey => $id));
            $this->request->data = $this->Chapter->find('first', $options);
        }
        $fields = $this->Chapter->Field->find('list');
        $this->set(compact('fields'));
    }

    /**
     * delete method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function delete($id = null) {
        $this->Chapter->id = $id;
        if (!$this->Chapter->exists()) {
            throw new NotFoundException(__('Invalid chapter'));
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->Chapter->delete()) {
            return $this->flash(__('The chapter has been deleted.'), array('action' => 'index'));
        } else {
            return $this->flash(__('The chapter could not be deleted. Please, try again.'), array('action' => 'index'));
        }
    }

}
