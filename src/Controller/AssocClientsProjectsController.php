<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * AssocClientsProjects Controller
 *
 * @property \App\Model\Table\AssocClientsProjectsTable $AssocClientsProjects
 */
class AssocClientsProjectsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Clients', 'Projects']
        ];
        $assocClientsProjects = $this->paginate($this->AssocClientsProjects);

        $this->set(compact('assocClientsProjects'));
        $this->set('_serialize', ['assocClientsProjects']);
    }

    /**
     * View method
     *
     * @param string|null $id Assoc Clients Project id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $assocClientsProject = $this->AssocClientsProjects->get($id, [
            'contain' => ['Clients', 'Projects']
        ]);

        $this->set('assocClientsProject', $assocClientsProject);
        $this->set('_serialize', ['assocClientsProject']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $assocClientsProject = $this->AssocClientsProjects->newEntity();
        if ($this->request->is('post')) {
            $assocClientsProject = $this->AssocClientsProjects->patchEntity($assocClientsProject, $this->request->data);
            if ($this->AssocClientsProjects->save($assocClientsProject)) {
                $this->Flash->success(__('The assoc clients project has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The assoc clients project could not be saved. Please, try again.'));
            }
        }
        $clients = $this->AssocClientsProjects->Clients->find('list', ['limit' => 200]);
        $projects = $this->AssocClientsProjects->Projects->find('list', ['limit' => 200]);
        $this->set(compact('assocClientsProject', 'clients', 'projects'));
        $this->set('_serialize', ['assocClientsProject']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Assoc Clients Project id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $assocClientsProject = $this->AssocClientsProjects->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $assocClientsProject = $this->AssocClientsProjects->patchEntity($assocClientsProject, $this->request->data);
            if ($this->AssocClientsProjects->save($assocClientsProject)) {
                $this->Flash->success(__('The assoc clients project has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The assoc clients project could not be saved. Please, try again.'));
            }
        }
        $clients = $this->AssocClientsProjects->Clients->find('list', ['limit' => 200]);
        $projects = $this->AssocClientsProjects->Projects->find('list', ['limit' => 200]);
        $this->set(compact('assocClientsProject', 'clients', 'projects'));
        $this->set('_serialize', ['assocClientsProject']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Assoc Clients Project id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $assocClientsProject = $this->AssocClientsProjects->get($id);
        if ($this->AssocClientsProjects->delete($assocClientsProject)) {
            $this->Flash->success(__('The assoc clients project has been deleted.'));
        } else {
            $this->Flash->error(__('The assoc clients project could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
