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
                    'Admin.email' => $this->request->data['Admin']['email'],
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

                    $this->Session->setFlash('You are now loged in.', 'flash_success');
                    $this->redirect($this->Auth->redirect());
                }
            }

            // not successful login
            $admin = $this->Admin->findByEmail($this->request->data['Admin']['email']);
            
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
                    $this->Auth->flash('wrong email or password.');

                    $this->Admin->invalidate('email', 'invalid email');
                    $this->Admin->invalidate('password', 'invalid password');
                }
            }
            else
            {
                $this->Auth->flash('wrong email or password.');

                $this->Admin->invalidate('email', 'invalid email');
                $this->Admin->invalidate('password', 'invalid password');
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
    
    public function index()
    {
        if ($this->Auth->user('admin') != true) {
            $this->Session->setFlash('sorry dude, this is nothing for you...', 'flash_fail');
            $this->redirect('/');
        }
        
        $admins = $this->Admin->find('all');
        $this->set('admins', $admins);
    }
    public function add()
    {
        if ($this->Auth->user('admin') != true) {
            $this->Session->setFlash('sorry dude, this is nothing for you...', 'flash_fail');
            $this->redirect('/');
        }

        if ($this->request->is('post'))
        {
            $this->Admin->create();
            
            if ($this->Admin->save($this->request->data))
            {
                $this->Session->setFlash('domain has been created.', 'flash_success');
                $this->redirect(array('action' => 'edit', $this->Admin->getLastInsertID()));
            }
            else
                $this->Session->setFlash('The domain could not be saved. Please, try again.', 'flash_fail');
        }
    }
    public function edit($id)
    {
        if ($this->Auth->user('admin') != true) {
            $this->Session->setFlash('sorry dude, this is nothing for you...', 'flash_fail');
            $this->redirect('/');
        }
        
        if ($this->request->is('post') || $this->request->is('put'))
        {            
            // update password only if chagned
            if(!empty($this->request->data['Admin']['password']))
                $this->request->data['Admin']['password'] = Security::hash($this->request->data['Admin']['password'], null, true);
            else
                unset($this->request->data['Admin']['password']);
            
            $this->loadModel('Domain');
            $domain = $this->Domain->find('first');
            $this->request->data['Domain'][0] = $domain['Domain'];
            pr($this->request->data);
            //exit();
            
            if ($this->Admin->saveAssociated($this->request->data))
                $this->Session->setFlash('The settings has been saved successfully.', 'flash_success');
            else
                $this->Session->setFlash('The settings could not be saved. Please, try again.', 'flash_fail');
        }
        else
            $this->request->data = $this->Admin->findById($id);
        
        $admin = $this->Admin->findById($id);
        $admin_domains = array();
        
        foreach($admin['Domain'] as $domain)
            $admin_domains[] = $domain['domain'];
        
        $this->loadModel('Domain');
        $this->set('admin', $admin);
        $this->set('admin_domains', $admin_domains);
        $this->set('domains', $this->Domain->find('all'));
    }
    public function delete($id = null)
    {
        if ($this->Auth->user('admin') != true) {
            $this->Session->setFlash('sorry dude, this is nothing for you...', 'flash_fail');
            $this->redirect('/');
        }
        
        $this->Admin->id = $id;
        
        if (!$this->Admin->exists())
            throw new NotFoundException('Admin not found.');
        
        if ($this->Admin->delete())
            $this->Session->setFlash('The admin has been deleted successfully.', 'flash_success');
        else
            $this->Session->setFlash('The admin could not be deleted. Please, try again.', 'flash_fail');
        
        $this->redirect(array('controller' => 'admins', 'action' => 'index'));
    }
    
    function settings()
    {
        $this->Admin->id = $this->Auth->user('id');
        $admin = $this->Admin->read(null, $this->Auth->user('id'));
        
        // save data
        if ($this->request->is('post') || $this->request->is('put'))
        {
            // update password only if chagned
            if(!empty($this->request->data['Admin']['password']))
                $this->request->data['Admin']['password'] = Security::hash($this->request->data['Admin']['password'], null, true);
            else
                unset($this->request->data['Admin']['password']);
            
            if ($this->Admin->save($this->request->data))
                $this->Session->setFlash('The settings has been saved successfully.', 'flash_success');
            else
                $this->Session->setFlash('The settings could not be saved. Please, try again.', 'flash_fail');
        }
        else
            $this->request->data = $admin;
    }
    function getPW($cleartext_pw)
    {
        exit(Security::hash($cleartext_pw, null, true));
    }
}