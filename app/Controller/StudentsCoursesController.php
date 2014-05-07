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
	}}
