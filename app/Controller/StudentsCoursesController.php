<?php

App::uses('AppController', 'Controller');

/**
 * StudentsCourses Controller
 *
 * @property StudentsCourse $StudentsCourse
 * @property PaginatorComponent $Paginator
 */
class StudentsCoursesController extends AppController {

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
        $this->StudentsCourse->recursive = 0;
        $this->set('studentsCourses', $this->Paginator->paginate());
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        if (!$this->StudentsCourse->exists($id)) {
            throw new NotFoundException(__('Invalid students course'));
        }
        $options = array('conditions' => array('StudentsCourse.' . $this->StudentsCourse->primaryKey => $id));
        $this->set('studentsCourse', $this->StudentsCourse->find('first', $options));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        if ($this->request->is('post')) {
            $this->StudentsCourse->create();
            if ($this->StudentsCourse->save($this->request->data)) {
                $this->Session->setFlash(__('The students course has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The students course could not be saved. Please, try again.'));
            }
        }
        $students = $this->StudentsCourse->Student->find('list');
        $courses = $this->StudentsCourse->Course->find('list');
        $this->set(compact('students', 'courses'));
    }

    public function register($course_id) {
        //Kiem tra khoa hoc co ton tai ko
        $this->StudentsCourse->Course->id = $course_id;
        $loggin_id = $this->Auth->user('id');
        if (!$this->StudentsCourse->Course->exists()) {
            throw new Exception('Không tồn tại khóa học.');
        }

        //Lay danh muc cac khoa da dang ky
        //$khoa_da_dang_ky=$this->StudentsCourse->getEnrolledCourses($this->Auth->user('id'));

        $conditions = array('StudentsCourse.student_id' => $loggin_id, 'StudentsCourse.course_id' => $course_id);

        $exist = $this->StudentsCourse->find('count', array('conditions' => $conditions, 'recursive' => -1));
        if ($exist > 0) {
            $this->Session->setFlash('Bạn đã đăng ký khóa học này rồi', 'alert', array('plugin' => 'BoostCake', 'class' => 'alert-warning'));
            return $this->redirect(array('student' => true, 'controller' => 'dashboards', 'action' => 'home'));
        }
        $data = array('student_id' => $loggin_id, 'course_id' => $course_id);
        if ($this->StudentsCourse->save($data)) {
            $this->Session->setFlash('Bạn đã đăng ký khóa học thành công!', 'alert', array('plugin' => 'BoostCake', 'class' => 'alert-success'));
            return $this->redirect(array('student' => true, 'controller' => 'dashboards', 'action' => 'home'));
        } else {
            $this->Session->setFlash('Đăng ký khóa học thất bại!', 'alert', array('plugin' => 'BoostCake', 'class' => 'alert-warning'));
            return $this->redirect(array('student' => true, 'controller' => 'dashboards', 'action' => 'home'));
        }
    }

    public function canceled($course_id) {

        $this->StudentsCourse->course_id = $course_id;
        $loggin_id = $this->Auth->user('id');
        $data = array('student_id' => $loggin_id, 'course_id' => $course_id);
        $row=$this->StudentsCourse->find('first',array('conditions'=>$data,'fields'=>array('id')));
      
        if ($this->StudentsCourse->delete($row['StudentsCourse']['id'])) {
            $this->Session->setFlash('Bạn đã hủy khóa học thành công!', 'alert', array('plugin' => 'BoostCake', 'class' => 'alert-success'));
            return $this->redirect(array('student' => true, 'controller' => 'dashboards', 'action' => 'home'));
        } else {
            $this->Session->setFlash('Hủy khóa học thất bại!', 'alert', array('plugin' => 'BoostCake', 'class' => 'alert-warning'));
            return $this->redirect(array('student' => true, 'controller' => 'dashboards', 'action' => 'home'));
        }
    }

    /**
     * edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function edit($id = null) {
        if (!$this->StudentsCourse->exists($id)) {
            throw new NotFoundException(__('Invalid students course'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->StudentsCourse->save($this->request->data)) {
                $this->Session->setFlash(__('The students course has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The students course could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('StudentsCourse.' . $this->StudentsCourse->primaryKey => $id));
            $this->request->data = $this->StudentsCourse->find('first', $options);
        }
        $students = $this->StudentsCourse->Student->find('list');
        $courses = $this->StudentsCourse->Course->find('list');
        $this->set(compact('students', 'courses'));
    }

    /**
     * delete method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function delete($id = null) {
        $this->StudentsCourse->id = $id;
        if (!$this->StudentsCourse->exists()) {
            throw new NotFoundException(__('Invalid students course'));
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->StudentsCourse->delete()) {
            $this->Session->setFlash(__('The students course has been deleted.'));
        } else {
            $this->Session->setFlash(__('The students course could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'index'));
    }

}
