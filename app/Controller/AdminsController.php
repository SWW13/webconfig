<?php
App::uses('AppController', 'Controller');
App::uses('Security', 'Utility');

class AdminsController extends AppController
{
    public function beforeFilter()
    {
        parent::beforeFilter();
        $this->Auth->allow(array('login', 'logout'));
        
        if(Configure::read('debug') >= 2)
            $this->Auth->allow(array('getPW'));
    }

    function login()
    {
        $this->set('title_for_layout', 'Login');
        
        // allready loged in?
        if ($this->Auth->loggedIn())
        {
            $this->Session->setFlash('You are allready loged in.', 'flash_notice');
            $this->redirect($this->Auth->redirect());
        }

        if($this->request->data) {
            // check if admin exists
            $admin = $this->Admin->find('first', array(
                'conditions' => array(
                    'Admin.username' => $this->request->data['Admin']['username'],
                    'OR' => array(
                        'Admin.locked_until <= "'.date('Y-m-d H:i:s').'"',
                        'Admin.locked_until' => null
                    )
                )
            ));
            if($admin) {
                if ($this->Auth->login()) {
                    $this->Admin->id = $admin['Admin']['id'];
                    $this->Admin->saveField('failed_logins', 0);
                    $this->Admin->saveField('locked_until', null);

                    $this->Session->setFlash('Du hast dich erfolgreich eingeloggt.', 'flash_success');
                    $this->redirect($this->Auth->redirect());
                }
            }

            // not successful login
            $admin = $this->Admin->findByUsername($this->request->data['Admin']['username']);
            
            if($admin)
            {
                // count failed logins +1
                $this->Admin->id = $admin['Admin']['id'];
                $this->Admin->saveField('failed_logins', $failed_logins = ($admin['Admin']['failed_logins'] + 1));
                
                // more then 3 failed logins
                if($failed_logins > 3)
                {
                    // unlcoked => lock
                    if($admin['Admin']['locked_until'] == null)
                    {
                        $this->Admin->saveField('locked_until', date('Y-m-d H:i:s', strtotime('30 minutes')));
                        $this->Auth->flash('Your Account was locked for 30mins because of too many failed logins.');
                    }
                    // locked
                    else
                    {
                        $this->Auth->flash('Your Account is locked for 30mins because of too many failed logins.');
                    }
                }
                else
                {
                    $this->Auth->flash('Wrong Username or Password.');

                    $this->Admin->invalidate('email', 'Invalid Username');
                    $this->Admin->invalidate('password', 'Invalid Password');
                }
            }
            else
            {
                $this->Auth->flash('Wrong Username or Password.');

                $this->Admin->invalidate('email', 'Invalid Username');
                $this->Admin->invalidate('password', 'Invalid Password');
            }

        }
    }

    function logout()
    {
        if ($this->Auth->loggedIn())
        {
            $this->Session->setFlash('You are now loged out.', 'flash_success');
            $this->redirect($this->Auth->logout());
        }
        else
        {
            $this->Session->setFlash('You are allready loged out.', 'flash_notice');
            $this->redirect('/');
        }
    }
    
    function getPW($cleartext_pw)
    {
        exit(Security::hash($cleartext_pw, null, true));
    }
}