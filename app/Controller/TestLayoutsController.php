<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

App::uses('AppController', 'Controller');

/**
 * CakePHP TestLayoutsController
 * @author NguyenThai
 */
class TestLayoutsController extends AppController {

    
    public function admin() {
        $this->layout='admin';
    }

    public function student() {
        $this->layout='student';
    }
    public function teacher() {
        $this->layout='teacher';
    }
    
    public function boss() {
        $this->layout='boss';
    }
    public function fieldsManager() {
        $this->layout='fields_manager';
    }
}
