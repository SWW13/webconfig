<?php
App::uses('AppController', 'Controller');

class ForwardingsController extends AppController
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
                $this->redirect(array('controller' => 'domains', 'action' => 'view', $forwarding['Domain']['id']));
            }
        }
        
        // save data
        if ($this->request->is('post') || $this->request->is('put'))
        {
            $this->request->data['Forwarding']['source'] = $this->request->data['Forwarding']['local'] . '@' . $forwarding['Domain']['domain'];
            $this->request->data['Forwarding']['destination'] = str_replace("\n", ' ', $this->request->data['Forwarding']['destination']);
            
            if ($this->Forwarding->save($this->request->data))
            {
                $this->Session->setFlash('The forwarding has been saved successfully.', 'flash_success');
                $this->redirect(array('controller' => 'domains', 'action' => 'view', $forwarding['Domain']['id']));
            }
            else
                $this->Session->setFlash('The forwarding could not be saved. Please, try again.', 'flash_fail');
        }
        
        $this->set('domain', $domain);
    }

    public function edit($id = null)
    {
        $this->Forwarding->id = $id;
        
        if (!$this->Forwarding->exists())
            throw new NotFoundException('Forwarding not found.');
        
        $this->loadModel('Domain');
        $forwarding = $this->Forwarding->read(null, $id);
        $this->Domain->id = $forwarding['Domain']['id'];
        
        if (!$this->Domain->exists())
            throw new NotFoundException('Domain not found.');
        
        $domain = $this->Domain->read(null, $forwarding['Domain']['id']);
        
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
                $this->redirect(array('controller' => 'domains', 'action' => 'view', $forwarding['Domain']['id']));
            }
        }
        
        // save data
        if ($this->request->is('post') || $this->request->is('put'))
        {
            $this->request->data['Forwarding']['source'] = $this->request->data['Forwarding']['local'] . '@' . $forwarding['Domain']['domain'];
            $this->request->data['Forwarding']['destination'] = str_replace("\n", ' ', $this->request->data['Forwarding']['destination']);
            
            if ($this->Forwarding->save($this->request->data))
            {
                $this->Session->setFlash('The forwarding has been saved successfully.', 'flash_success');
                $this->redirect(array('controller' => 'domains', 'action' => 'view', $forwarding['Domain']['id']));
            }
            else
                $this->Session->setFlash('The forwarding could not be saved. Please, try again.', 'flash_fail');
        }
        else
        {
            $this->request->data = $forwarding;
            $this->request->data['Forwarding']['destination'] = str_replace(' ', "\n", $this->request->data['Forwarding']['destination']);
        }
        
        $this->set('forwarding', $forwarding);
    }

    public function delete($id = null)
    {
        if (!$this->request->is('post'))
        {
            throw new MethodNotAllowedException();
        }
        $this->Forwarding->id = $id;
        if (!$this->Forwarding->exists())
        {
            throw new NotFoundException(__('Invalid forwarding'));
        }
        if ($this->Forwarding->delete())
        {
            $this->Session->setFlash(__('Forwarding deleted'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('Forwarding was not deleted'));
        $this->redirect(array('action' => 'index'));
    }
}
