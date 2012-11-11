<?php
App::uses('Controller', 'Controller');


class AppController extends Controller {
    public $components = array('Session',
        'Security' => array(
            'csrfExpires' => '+4 hours',
            'csrfUseOnce' => false
        ),
        'Auth' => array(
            'loginAction' => array(
                'controller' => 'admins',
                'action' => 'login',
            ),
            'loginRedirect' => '/domains',
            'logoutRedirect' => '/',
            'authError' => 'Please login.',
            'flash' => array(
                'element' => 'flash_fail',
                'key' => 'auth',
                'params' => array()
            ),
            'authenticate' => array(
                'Form' => array(
                    'userModel' => 'Admin',
                    'fields' => array('username' => 'email')
               )
            )
        ));
    public $helpers = array('Html', 'Js', 'Form', 'Session');
    
    function beforeFilter()
    {
        // require ssl
        if(Configure::read('debug') == 0)
            $this->Security->requireSecure('*');
        
        // set admin if loged in
        if($this->Auth->user())
            $this->set('admin', $this->Auth->user());
    }
}
