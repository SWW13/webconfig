<?php
App::uses('AppModel', 'Model');

class Domain extends AppModel {
    
    public $validate = array(
        'domain' => array(
            'rule' => '/^[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}$/',
            'message' => 'invalid domain name'
        ),
    );
    
    public $hasMany = array('Forwarding', 'User');
    public $hasAndBelongsToMany = array('Admin');

}
