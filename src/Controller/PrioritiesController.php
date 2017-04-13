<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Priorities Controller
 *
 * @property \App\Model\Table\PrioritiesTable $Priorities
 */
class PrioritiesController extends AppController
{
    public function initialize(){
        parent::initialize();
        $this->pageName = 'Priorities';
    }
    
    public function isAuthorized($user = null){
        if(parent::isAuthorized($user)){
            return true;
        }
        
        if((isset($user['type']))&&(in_array($user['type'], ['user', 'member']))){
            if((isset($user['priorities_manager']))&&($user['priorities_manager'])){
                return true;
            }
        }
        return false;
    }
    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = ['maxLimit' => 15, 'order' => ['order_priority' => 'ASC']];
        $priorities = $this->paginate($this->Priorities);
        $pageName = $this->pageName;
        $this->set(compact('priorities', 'pageName'));
        $this->set('_serialize', ['priorities']);
    }

    /**
     * View method
     *
     * @param string|null $id Priority id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $priority = $this->Priorities->get($id, [
            'contain' => ['Projects']
        ]);
        $pageName = $this->pageName;
        $this->set(compact('priority', 'pageName'));
        $this->set('_serialize', ['priority']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $priority = $this->Priorities->newEntity();
        if ($this->request->is('post')) {
            $priority = $this->Priorities->patchEntity($priority, $this->request->data);
            if ($this->Priorities->save($priority)) {
                $this->Flash->success(__('has been saved.', ['La ', __('priority'), 'e']));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('could not be saved. Please, try again.', ['La ', __('priority'), 'e']));
            }
        }
        $pageName = $this->pageName;
        $this->set(compact('priority', 'pageName'));
        $this->set('_serialize', ['priority']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Priority id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $priority = $this->Priorities->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $priority = $this->Priorities->patchEntity($priority, $this->request->data);
            if ($this->Priorities->save($priority)) {
                $this->Flash->success(__('has been saved.', ['La ', __('priority'), 'e']));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('could not be saved. Please, try again.', ['La ', __('priority'), 'e']));
            }
        }
        $pageName = $this->pageName;
        $this->set(compact('priority', 'pageName'));
        $this->set('_serialize', ['priority']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Priority id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $priority = $this->Priorities->get($id);
        if ($this->Priorities->delete($priority)) {
            $this->Flash->success(__('has been deleted.', ['La ', __('priority'), 'e']));
        } else {
            $this->Flash->error(__('could not be deleted. Please, try again.', ['La ', __('priority'), 'e']));
        }

        return $this->redirect(['action' => 'index']);
    }
}
