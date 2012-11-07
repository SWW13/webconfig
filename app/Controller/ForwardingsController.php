<?php

App::uses('AppController', 'Controller');

class ForwardingsController extends AppController {

    public function add($domain_id) {
        if ($this->request->is('post')) {
            $this->Forwarding->create();
            if ($this->Forwarding->save($this->request->data)) {
                $this->Session->setFlash(__('The forwarding has been saved'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The forwarding could not be saved. Please, try again.'));
            }
        }
        $domains = $this->Forwarding->Domain->find('list');
        $this->set(compact('domains'));
    }

    public function edit($id = null) {
        $this->Forwarding->id = $id;
        if (!$this->Forwarding->exists()) {
            throw new NotFoundException(__('Invalid forwarding'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->Forwarding->save($this->request->data)) {
                $this->Session->setFlash(__('The forwarding has been saved'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The forwarding could not be saved. Please, try again.'));
            }
        } else {
            $this->request->data = $this->Forwarding->read(null, $id);
        }
        $domains = $this->Forwarding->Domain->find('list');
        $this->set(compact('domains'));
    }

    public function delete($id = null) {
        if (!$this->request->is('post')) {
            throw new MethodNotAllowedException();
        }
        $this->Forwarding->id = $id;
        if (!$this->Forwarding->exists()) {
            throw new NotFoundException(__('Invalid forwarding'));
        }
        if ($this->Forwarding->delete()) {
            $this->Session->setFlash(__('Forwarding deleted'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('Forwarding was not deleted'));
        $this->redirect(array('action' => 'index'));
    }

}
