<?php

App::uses('AppController', 'Controller');

/**
 * CoursesRooms Controller
 *
 * @property CoursesRoom $CoursesRoom
 * @property PaginatorComponent $Paginator
 */
class CoursesRoomsController extends AppController {

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
        $course_id = ($this->request->query['course_id']);

        $conditions = array();
        if ($course_id) {
            $conditions = Set::merge($conditions, array('CoursesRoom.course_id' => $course_id, 'CoursesRoom.begin is not null'));
        }
        $contain = array('Room' => array('fields' => array('id', 'name')));
        $options = array('conditions' => $conditions, 'contain' => $contain);
        $buois = $this->CoursesRoom->find('all', $options);

        $result = Set::classicExtract($buois, '{n}.CoursesRoom');
        $this->set(array(
            'result' => $result,
            '_serialize' => 'result'
        ));
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        if (!$this->CoursesRoom->exists($id)) {
            throw new NotFoundException(__('Invalid courses room'));
        }
        $options = array('conditions' => array('CoursesRoom.' . $this->CoursesRoom->primaryKey => $id));

        $this->set('coursesRoom', $this->CoursesRoom->find('first', $options));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        if (!empty($this->request->data)) {
            $this->request->data['CoursesRoom']['created_user_id'] = $this->Auth->user('id');
            if ($this->CoursesRoom->save($this->request->data)) {
                $this->CoursesRoom->Room->id = $this->CoursesRoom->field('room_id');
                $room_name = $this->CoursesRoom->Room->field('name');
                if ($this->request->is('ajax')) {
                    $response = array(
                        'status' => 1,
                        'id' => $this->CoursesRoom->id,
                        'name' => $this->CoursesRoom->field('name'),
                        'priority' => $this->CoursesRoom->field('priority'),
                        'currColor' => $this->CoursesRoom->field('color'),
                        'room_id' => $this->CoursesRoom->field('room_id'),
                        'room' => $room_name
                    );
                    $this->set('response', $response);
                    $this->set('_serialize', array('response'));
                } else {
                    $this->Session->setFlash('Đã lưu thành công!');
                    $this->redirect(array('action' => 'index'));
                }
            } else {
                /* Yeu cau bang ajax */
                if ($this->RequestHandler->isAjax()) {

                    $response = array('status' => 0, 'message' => '<div class="alert alert-warning alert-dismissable">
  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
  <strong>Cảnh báo!</strong> Lưu không thành công, vui lòng kiểm tra lại thông tin.</div>');
                    $this->set('response', $response);
                    $this->set('_serialize', array('response'));
                } else {
                    $this->Session->setFlash('Lưu không thành công');
                }
            }
        }
        $courses = $this->CoursesRoom->Course->find('list');
        $rooms = $this->CoursesRoom->Room->find('list');
        $this->set(compact('courses', 'rooms'));
    }

    /**
     * edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function edit($id = null) {
        if (!$this->CoursesRoom->exists($id)) {
            throw new NotFoundException(__('Invalid courses room'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->CoursesRoom->save($this->request->data)) {
                $this->Session->setFlash(__('The courses room has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The courses room could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('CoursesRoom.' . $this->CoursesRoom->primaryKey => $id));
            $this->request->data = $this->CoursesRoom->find('first', $options);
        }
        $courses = $this->CoursesRoom->Course->find('list');
        $rooms = $this->CoursesRoom->Room->find('list');
        $this->set(compact('courses', 'rooms'));
    }

    /**
     * delete method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function delete($id = null) {
        $this->CoursesRoom->id = $id;
        if (!$this->CoursesRoom->exists()) {
            throw new NotFoundException(__('Invalid courses room'));
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->CoursesRoom->delete()) {
            $this->Session->setFlash(__('The courses room has been deleted.'));
        } else {
            $this->Session->setFlash(__('The courses room could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'index'));
    }

}
