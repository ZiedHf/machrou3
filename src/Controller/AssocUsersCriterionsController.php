<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * AssocUsersCriterions Controller
 *
 * @property \App\Model\Table\AssocUsersCriterionsTable $AssocUsersCriterions
 */
class AssocUsersCriterionsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users', 'Criterions']
        ];
        $assocUsersCriterions = $this->paginate($this->AssocUsersCriterions);

        $this->set(compact('assocUsersCriterions'));
        $this->set('_serialize', ['assocUsersCriterions']);
    }

    /**
     * View method
     *
     * @param string|null $id Assoc Users Criterion id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $assocUsersCriterion = $this->AssocUsersCriterions->get($id, [
            'contain' => ['Users', 'Criterions']
        ]);

        $this->set('assocUsersCriterion', $assocUsersCriterion);
        $this->set('_serialize', ['assocUsersCriterion']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $assocUsersCriterion = $this->AssocUsersCriterions->newEntity();
        if ($this->request->is('post')) {
            $assocUsersCriterion = $this->AssocUsersCriterions->patchEntity($assocUsersCriterion, $this->request->data);
            if ($this->AssocUsersCriterions->save($assocUsersCriterion)) {
                $this->Flash->success(__('The assoc users criterion has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The assoc users criterion could not be saved. Please, try again.'));
            }
        }
        $users = $this->AssocUsersCriterions->Users->find('list', ['limit' => 200]);
        $criterions = $this->AssocUsersCriterions->Criterions->find('list', ['limit' => 200]);
        $this->set(compact('assocUsersCriterion', 'users', 'criterions'));
        $this->set('_serialize', ['assocUsersCriterion']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Assoc Users Criterion id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $assocUsersCriterion = $this->AssocUsersCriterions->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $assocUsersCriterion = $this->AssocUsersCriterions->patchEntity($assocUsersCriterion, $this->request->data);
            if ($this->AssocUsersCriterions->save($assocUsersCriterion)) {
                $this->Flash->success(__('The assoc users criterion has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The assoc users criterion could not be saved. Please, try again.'));
            }
        }
        $users = $this->AssocUsersCriterions->Users->find('list', ['limit' => 200]);
        $criterions = $this->AssocUsersCriterions->Criterions->find('list', ['limit' => 200]);
        $this->set(compact('assocUsersCriterion', 'users', 'criterions'));
        $this->set('_serialize', ['assocUsersCriterion']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Assoc Users Criterion id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $assocUsersCriterion = $this->AssocUsersCriterions->get($id);
        $user_id = $assocUsersCriterion->user_id;
        if ($this->AssocUsersCriterions->delete($assocUsersCriterion)) {
            $this->Flash->success(__('The assoc users criterion has been deleted.'));
        } else {
            $this->Flash->error(__('The assoc users criterion could not be deleted. Please, try again.'));
        }
        
        return (isset($user_id)) ? $this->redirect(['controller' => 'Users', 'action' => 'view', $user_id]) : $this->redirect(['controller' => 'Users', 'action' => 'index']);
    }
}
