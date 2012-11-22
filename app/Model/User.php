<?php

App::uses('AppModel', 'Model');

class User extends AppModel
{
    public $validate = array(
        'domain_id' => array(
            'numeric' => array(
                'rule' => array('numeric'),
            ),
        ),
        'local' => array(
            'notempty' => array(
                'rule' => array('notempty'),
            ),
        ),
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
    ); 
    public $belongsTo = array('Domain');
}
