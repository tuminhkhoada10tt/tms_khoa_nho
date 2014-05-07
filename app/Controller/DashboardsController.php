<?php

App::uses('AppController', 'Controller');

/**
 * CakePHP DashboardsController
 * @author NguyenThai
 */
class DashboardsController extends AppController {

    public $uses = array('User', 'Group');

    public function home() {
        if ($this->Auth->loggedIn()) {
            $this->redirect(array('action' => 'loggedInMenu'));
        }
    }

    public function student_home() {
        $this->layout = 'student';
    }

    public function teacher_home() {
        $this->layout = 'teacher';
    }

    public function manager_home() {
        $this->layout = 'manager';
    }

    public function fields_manager_home() {
        $this->layout = 'fields_manager';
    }

    public function boss_home() {
        $this->layout = 'boss';
    }

    public function admin_home() {
        $this->layout = 'admin';
    }

    public function loggedInMenu() {

        if (!empty($this->request->query)) {
            $layout = $this->request->query['layout'];
            $this->Session->write('layout', $layout);
            $this->Session->write('change_layout', 1);
            return $this->redirect(array('controller' => 'dashboards', 'action' => $layout . '_home'));
        }else{
            
        }
        $user = $this->User->find('first', array('recursive' => 2, 'conditions' => array('User.id' => $this->Auth->user('id'))));
        if (count($user['Group']) == 1) {
            $this->Session->write('layout', $user['Group'][0]['alias']);
            $this->Session->write('change_layout', 0);
            $this->Session->write('group_name', $user['Group'][0]['name']);
            return $this->redirect(array('controller' => 'dashboards', 'action' => $user['Group'][0]['alias'] . '_home'));
        }
        
        
        $this->layout = 'group_select';
        $this->set('users', $user);
    }

}
