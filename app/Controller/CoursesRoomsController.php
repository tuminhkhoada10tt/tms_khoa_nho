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
		$this->CoursesRoom->recursive = 0;
		$this->set('coursesRooms', $this->Paginator->paginate());
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
		if ($this->request->is('post')) {
			$this->CoursesRoom->create();
			if ($this->CoursesRoom->save($this->request->data)) {
				return $this->flash(__('The courses room has been saved.'), array('action' => 'index'));
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
				return $this->flash(__('The courses room has been saved.'), array('action' => 'index'));
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
			return $this->flash(__('The courses room has been deleted.'), array('action' => 'index'));
		} else {
			return $this->flash(__('The courses room could not be deleted. Please, try again.'), array('action' => 'index'));
		}
	}}
