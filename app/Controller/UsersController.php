<?php

App::uses('AppController', 'Controller');

class UsersController extends AppController
{
    public function add($domain_id)
    {
         $this->loadModel('Domain');
        $this->Domain->id = $domain_id;
        
        if (!$this->Domain->exists())
            throw new NotFoundException('Domain not found.');
        
        $domain = $this->Domain->read(null, $domain_id);
        
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
                $this->redirect(array('controller' => 'domains', 'action' => 'view', $domain['Domain']['id']));
            }
        }
        
        // save data
        if ($this->request->is('post') || $this->request->is('put'))
        {
            $vmail_dir = Configure::read('webconfig.vmail_dir');
            $domain_name = $domain['Domain']['domain'];
            $local = $this->request->data['User']['local'];
            $this->request->data['User']['domain_id'] = $domain_id;
            $this->request->data['User']['email'] = $local . '@' . $domain_name;
            $this->request->data['User']['password'] = crypt($this->request->data['User']['password']);
            
            if(empty($vmail_dir) || substr_count($vmail_dir, '/') < 2)
                throw new InternalErrorException("Missing vmail_dir config or contains less then two '/'.");
            
            exec("maildirmake $vmail_dir/".escapeshellcmd($domain_name).'/'.escapeshellcmd($local), $output, $result);
            
            if($result !== 0)
                throw new InternalErrorException("maildirmake failed with error code $result.");
            
            if ($this->User->save($this->request->data))
            {
                $this->Session->setFlash('The user has been saved successfully.', 'flash_success');
                $this->redirect(array('controller' => 'domains', 'action' => 'view', $domain['Domain']['id']));
            }
            else
                $this->Session->setFlash('The user could not be saved. Please, try again.', 'flash_fail');
        }
        
        $this->set('domain', $domain);
    }

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
    
    public function delete($id = null)
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
        
        $vmail_dir = Configure::read('webconfig.vmail_dir');
        $domain_name = $user['Domain']['domain'];
        $local = $user['User']['local'];
        
        if(empty($vmail_dir) || substr_count($vmail_dir, '/') < 2)
            throw new InternalErrorException("Missing vmail_dir config or contains less then two '/'.");
            
        exec("rm -R $vmail_dir/".escapeshellcmd($domain_name).'/'.escapeshellcmd($local), $output, $result);
        
        if($result !== 0)
                throw new InternalErrorException("Delete maildir failed with error code $result.");
        
        if ($this->User->delete())
            $this->Session->setFlash('The user has been deleted successfully.', 'flash_success');
        else
            $this->Session->setFlash('The user could not be deleted. Please, try again.', 'flash_fail');
        
        $this->redirect(array('controller' => 'domains', 'action' => 'view', $user['Domain']['id']));
    }

}
