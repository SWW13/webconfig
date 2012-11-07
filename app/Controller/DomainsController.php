<?php
App::uses('AppController', 'Controller');

class DomainsController extends AppController {

    public function index() {
        $this->Domain->recursive = 0;
        $this->set('domains', $this->Domain->find('all'));
    }

    public function view($id = null) {
        $this->Domain->id = $id;
        
        if (!$this->Domain->exists())
            throw new NotFoundException(__('Invalid domain'));
        
        $this->set('domain', $this->Domain->read(null, $id));
    }
    
    public function add() {
        if ($this->request->is('post')) {
            $this->Domain->create();
            if ($this->Domain->save($this->request->data)) {
                $this->Session->setFlash(__('The domain has been saved'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The domain could not be saved. Please, try again.'));
            }
        }
    }

}
