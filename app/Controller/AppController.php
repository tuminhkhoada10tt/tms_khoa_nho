<?php

App::uses('Controller', 'Controller');

class AppController extends Controller {
    public $components = array(
        'Session', 'RequestHandler',
        'DebugKit.Toolbar',
        'Paginator',
        'Acl',
        'Auth' => array(
            'authorize' => array(
                'Controller',
                'Actions' => array('actionPath' => 'controllers'),
                'Authorize.Acl' => array('actionPath' => 'Models/')
            ))
    );
    public $helpers = array('Session',
        'Js',
        'Html' => array('className' => 'BoostCake.BoostCakeHtml'),
        'Form' => array('className' => 'BoostCake.BoostCakeForm'),
        'Paginator' => array('className' => 'BoostCake.BoostCakePaginator')
    );

    public function beforeRender() {
        parent::beforeRender();
        if ($this->Auth->loggedIn()) {
            if ($this->Session->check('layout')&&!$this->request->is('ajax'))
                $this->layout = $this->Session->read('layout');
        }
    }

    function beforeFilter() {
        
        if (in_array($this->action, array('home', 'login'))) {
            $this->Auth->allow($this->action);
        }
        $this->Auth->loginAction = array(
            'controller' => 'users',
            'action' => 'login',
            'admin' => false,
            'plugin' => false
        );
        $this->Auth->logoutRedirect = array(
            'controller' => 'dashboards',
            'action' => 'home',
            'admin' => false,
            'plugin' => false
        );
        $this->Auth->loginRedirect = array(
            'controller' => 'dashboards',
            'action' => 'home',
            'admin' => false,
            'plugin' => false
        );
    }

    public function isAuthorized($user) {

        return $this->Auth->loggedIn();
    }

    public function elfinder() {
        $this->TinymceElfinder->elfinder();
    }

    public function connector() {
        $this->TinymceElfinder->connector();
    }

}