<?php

App::uses('AppController', 'Controller');

/**
 * Courses Controller
 *
 * @property Course $Course
 * @property PaginatorComponent $Paginator
 */
class CoursesController extends AppController {

    /**
     * Components
     *
     * @var array
     */
    public $components = array('Paginator', 'Session', 'TinymceElfinder.TinymceElfinder');
    public $helpers = array('TinymceElfinder.TinymceElfinder');

    //public $uses=array('Room');
    public function beforeFilter() {
        parent::beforeFilter();
    }

    /**
     * index method
     *
     * @return void
     */
    public function index() {
        $this->Course->recursive = 0;
        $this->set('courses', $this->Paginator->paginate());
    }

    public function new_courses() {
        if ($this->Auth->loggedIn()) {
            $user = $this->Course->User->find('first', array('contain' => array('Group'), 'conditions' => array('User.id' => $this->Auth->user('id'))));
            if (count($user['Group']) == 1) {
                $this->Session->write('layout', $user['Group'][0]['alias']);
                $this->Session->write('change_layout', 0);
                $this->Session->write('group_name', $user['Group'][0]['name']);
                return $this->redirect(array('controller' => 'dashboards', 'action' => $user['Group'][0]['alias'] . '_home'));
            }
            //$this->layout = 'group_select';
            $this->set('users', $user);
        }
        $contain = array(
            'User' => array('fields' => array('id', 'name')), //create user
            'Teacher' => array('fields' => array('id', 'name')), //Teacher
            'StudentsCourse', //Khoa hoc
            'Chapter'//Chuyen de
        );
        $conditions = array('Course.status' => COURSE_REGISTERING);
        $this->Paginator->settings = array('contain' => $contain, 'conditions' => $conditions);
        $fields = $this->Course->Chapter->Field->find('list');
        $chapters = $this->Course->Chapter->find('list');
        $this->set(compact('fields', 'chapters'));
        $this->set('courses', $this->Paginator->paginate());
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        if (!$this->Course->exists($id)) {
            throw new NotFoundException(__('Invalid course'));
        }
        $options = array('conditions' => array('Course.' . $this->Course->primaryKey => $id));
        $this->set('course', $this->Course->find('first', $options));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {

        if ($this->request->is('post')) {
            $this->Course->create();
            if ($this->Course->save($this->request->data)) {
                $this->Session->setFlash(__('The course has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The course could not be saved. Please, try again.'));
            }
        }
        $chapters = $this->Course->Chapter->find('list');
        $teachers = $this->Course->Teacher->find('list');
        $this->set(compact('chapters', 'teachers'));
    }

    /*     * Fields manager */

    public function fields_manager_view($id = null) {

        if (!$this->Course->exists($id)) {
            throw new NotFoundException(__('Invalid course'));
        }
        $contain = array(
            'User' => array('fields' => array('id', 'name')),
            'CoursesRoom'=>array('Room'=>array('id','name'),'conditions'=>array('CoursesRoom.course_id' => $id, 'CoursesRoom.start is null')),
            'Teacher' => array('fields' => array('id', 'name', 'email', 'phone_number'), 'HocHam', 'HocVi'
            ), 'Chapter'
        );
        $options = array('conditions' => array('Course.' . $this->Course->primaryKey => $id), 'contain' => $contain);
        $rooms = $this->Course->CoursesRoom->Room->find('list');
        $course = $this->Course->find('first', $options);
        $this->set(compact('course', 'rooms'));
    }

    public function fields_manager_index($status = null) {

        $contain = array(
            'User' => array('fields' => array('id', 'name')),
            'Teacher' => array('fields' => array('id', 'name'),
            ), 'Chapter'
        );
        $conditions = array();
        if ($status) {
            $conditions = Set::merge($conditions, array('Course.status' => $status));
        }
        $this->Paginator->settings = array('contain' => $contain, 'conditions' => $conditions);
        $this->set('courses', $this->Paginator->paginate());
    }

    public function fields_manager_add() {

        if ($this->request->is('post')) {
            $this->Course->create();
            if ($this->Course->save($this->request->data)) {
                $this->Session->setFlash(__('The course has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The course could not be saved. Please, try again.'));
            }
        }
        $chapters = $this->Course->Chapter->find('list');
        $teachers = $this->Course->Teacher->find('list');
        $this->set(compact('chapters', 'teachers'));
    }

    public function fields_manager_edit($id = null) {
        if (!$this->Course->exists($id)) {
            throw new NotFoundException(__('Invalid course'));
        }

        if ($this->request->is(array('post', 'put'))) {
            if ($this->Course->save($this->request->data)) {
                $this->Session->setFlash(__('The course has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The course could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array(
                    'Course.' . $this->Course->primaryKey => $id),
                'contain' => array(
                    'Chapter' => array('fields' => array('id', 'name')),
                    'Teacher' => array('fields' => array('id', 'name'))));
            $this->request->data = $this->Course->find('first', $options);
        }
        $chapters = $this->Course->Chapter->find('list');
        $teachers = $this->Course->Teacher->find('list');
        $this->set(compact('chapters', 'teachers'));
    }

    /*     * End Fields manager */

    /**
     * edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function edit($id = null) {
        if (!$this->Course->exists($id)) {
            throw new NotFoundException(__('Invalid course'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->Course->save($this->request->data)) {
                $this->Session->setFlash(__('The course has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The course could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('Course.' . $this->Course->primaryKey => $id));
            $this->request->data = $this->Course->find('first', $options);
        }
        $chapters = $this->Course->Chapter->find('list');
        $teachers = $this->Course->Teacher->find('list');
        $this->set(compact('chapters', 'teachers'));
    }

    /**
     * delete method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function delete($id = null) {
        $this->Course->id = $id;
        if (!$this->Course->exists()) {
            throw new NotFoundException(__('Invalid course'));
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->Course->delete()) {
            $this->Session->setFlash(__('The course has been deleted.'));
        } else {
            $this->Session->setFlash(__('The course could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'index'));
    }

}
