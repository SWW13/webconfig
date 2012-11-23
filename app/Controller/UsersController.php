<?php

App::uses('AppController', 'Controller');

class UsersController extends AppController
{
    /*
    public function add()
    {
        if ($this->request->is('post'))
        {
            $this->User->create();
            if ($this->User->save($this->request->data))
            {
                $this->Session->setFlash(__('The user has been saved'));
                $this->redirect(array('action' => 'index'));
            }
            else
            {
                $this->Session->setFlash(__('The user could not be saved. Please, try again.'));
            }
        }
        $domains = $this->User->Domain->find('list');
        $this->set(compact('domains'));
    }
    */

    public function edit($id = null)
    {
        $this->User->id = $id;
        
        if (!$this->User->exists())
            throw new NotFoundException('User not found.');
        
        $this->loadModel('Domain');
        $user = $this->User->read(null, $id);
        $this->Domain->id = $user['Domain']['id'];
        
        if (!$this->Domain->exists())
            throw new NotFoundException('Domain not found.');
        
        $domain = $this->Domain->read(null, $user['Domain']['id']);
        
        // check for domain admin rights, if not a server admin
        if ($this->Auth->user('admin') == false)
        {
            $is_domain_admin = false;
            
            // check all admins
            foreach($domain['Admin'] as $admin)
            {
                if($admin['id'] === $this->Auth->user('id'))
                {
                    $is_domain_admin = true;
                    break;
                }
            }
            
            if(!$is_domain_admin)
            {
                $this->Session->setFlash('sorry dude, this is nothing for you...', 'flash_fail');
                $this->redirect('/');
            }
        }
        
        // save data
        if ($this->request->is('post') || $this->request->is('put'))
        {
            // change password
            if(!empty($this->request->data['User']['password']))
                $this->request->data['User']['password'] = crypt($this->request->data['User']['password']);
            else
                unset($this->request->data['User']['password']);
                
            if ($this->User->save($this->request->data))
            {
                $this->Session->setFlash('User changed successfully.', 'flash_success');
                $this->redirect(array('controller' => 'domains', 'action' => 'view', $user['Domain']['id']));
            }
            else
                $this->Session->setFlash('User could not be saved. Please, try again.', 'flash_fail');  
        }
        else
            $this->request->data = $user;
        
        $this->set('user', $user);
    }
    
    /*
    public function delete($id = null)
    {
        if (!$this->request->is('post'))
        {
            throw new MethodNotAllowedException();
        }
        $this->User->id = $id;
        if (!$this->User->exists())
        {
            throw new NotFoundException(__('Invalid user'));
        }
        if ($this->User->delete())
        {
            $this->Session->setFlash(__('User deleted'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('User was not deleted'));
        $this->redirect(array('action' => 'index'));
    }
    */

}
