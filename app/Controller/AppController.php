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
    }

    function beforeFilter() {

        if (!empty($this->params['prefix'])) {
            $this->layout = $this->params['prefix'];
        }
        if (in_array($this->action, array('home', 'login','new_courses'))) {
            $this->Auth->allow($this->action);
        }

        $this->Auth->loginAction = array(
            'controller' => 'users',
            'action' => 'login',
            'admin' => false,
            'plugin' => false
        );
        $this->Auth->logoutRedirect = array(
            'controller' => 'courses',
            'action' => 'new_courses',
            'admin' => false,
            'plugin' => false
        );
        $this->Auth->loginRedirect = array(
            'controller' => 'courses',
            'action' => 'new_courses',
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
