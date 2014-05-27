<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

App::uses('UsersController', 'Controller');

/**
 * CakePHP TeachersController
 * @author NguyenThai
 */
class TeachersController extends UsersController {

    public $group = 'teacher';

    public function index() {
        $teacher = $this->Teacher->Group->find('all', array(
            'conditions' => array('Group.id' => $this->Teacher->Group->getGroupIdByAlias('teacher')),
            'contain' => array('User' => array('fields' => array('id'), 'Group' => array('fields' => array('id'))))
        ));
        $result = Set::classicExtract($teacher[0]['User'], '{n}.id');
        $this->Paginator->settings = array('conditions' => array('User.id' => $result, 'User.created_user_id' => $this->Auth->user('id')));
        $this->set('users', $this->Paginator->paginate());
    }

}
