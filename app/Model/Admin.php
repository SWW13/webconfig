<?php
App::uses('AppModel', 'Model');

class Admin extends AppModel {

    public $validate = array(
        'email' => array(
            'email' => array(
                'rule' => array('email'),
            ),
        ),
        'password' => array(
            'notempty' => array(
                'rule' => array('notempty'),
            ),
        ),
        'admin' => array(
            'boolean' => array(
                'rule' => array('boolean'),
            ),
        ),
    );
    
    public $hasAndBelongsToMany = array('Domain');

}
