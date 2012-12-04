<?php
App::uses('AppController', 'Controller');

class DomainsController extends AppController {

    public function index()
    {
        if ($this->Auth->user('admin') == true)
        {
            $domains = $this->Domain->find('all');

            $this->set('domains', $domains);
            $this->render('index_admin');
        }
        else
        {
            $this->loadModel('Admin');
            $admin = $this->Admin->findById($this->Auth->user('id'));

            $this->set('domains', $admin['Domain']);
            $this->render();
        }
    }

    public function view($id = null)
    {
        $this->Domain->id = $id;
        
        if (!$this->Domain->exists())
            throw new NotFoundException('Domain not found.');
        
        $domain = $this->Domain->read(null, $id);
        
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
        
        $this->set('domain', $domain);
        $this->render();
    }

    public function add()
    {
        if ($this->Auth->user('admin') != true) {
            $this->Session->setFlash('sorry dude, this is nothing for you...', 'flash_fail');
            $this->redirect('/');
        }

        if ($this->request->is('post'))
        {
            $vmail_dir = Configure::read('webconfig.vmail_dir');
            $domain_name = $this->request->data['Domain']['domain'];

            if(empty($vmail_dir) || substr_count($vmail_dir, '/') < 2)
                throw new InternalErrorException("Missing vmail_dir config or contains less then two '/'.");

            exec("mkdir $vmail_dir/".escapeshellcmd($domain_name), $output, $result);

            if($result !== 0)
                    throw new InternalErrorException("Create doamin dir failed with error code $result.");
            
            if ($this->Domain->save($this->request->data))
            {
                $this->Session->setFlash('domain has been created.', 'flash_success');
                $this->redirect(array('action' => 'index'));
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

        /*if ($this->request->is('post') || $this->request->is('put'))
        {
            $this->Domain->create();
            
            if ($this->Domain->save($this->request->data))
            {
                $this->Session->setFlash('domain has been created.', 'flash_success');
                $this->redirect(array('action' => 'index'));
            }
            else
                $this->Session->setFlash('The domain could not be saved. Please, try again.', 'flash_fail');
        }
        else
            $this->set('domain', $this->Domain->findById($id));*/
        
        $this->set('domain', $this->Domain->findById($id));
    }

}
