<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * ProjectClientInfos Controller
 *
 * @property \App\Model\Table\ProjectClientInfosTable $ProjectClientInfos
 */
class ProjectClientInfosController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['AssocUsersProjects']
        ];
        $projectClientInfos = $this->paginate($this->ProjectClientInfos);

        $this->set(compact('projectClientInfos'));
        $this->set('_serialize', ['projectClientInfos']);
    }

    /**
     * View method
     *
     * @param string|null $id Project Client Info id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $projectClientInfo = $this->ProjectClientInfos->get($id, [
            'contain' => ['AssocUsersProjects']
        ]);

        $this->set('projectClientInfo', $projectClientInfo);
        $this->set('_serialize', ['projectClientInfo']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $projectClientInfo = $this->ProjectClientInfos->newEntity();
        if ($this->request->is('post')) {
            $projectClientInfo = $this->ProjectClientInfos->patchEntity($projectClientInfo, $this->request->data);
            if ($this->ProjectClientInfos->save($projectClientInfo)) {
                $this->Flash->success(__('The project client info has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The project client info could not be saved. Please, try again.'));
            }
        }
        $assocUsersProjects = $this->ProjectClientInfos->AssocUsersProjects->find('list', ['limit' => 200]);
        $this->set(compact('projectClientInfo', 'assocUsersProjects'));
        $this->set('_serialize', ['projectClientInfo']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Project Client Info id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $projectClientInfo = $this->ProjectClientInfos->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $projectClientInfo = $this->ProjectClientInfos->patchEntity($projectClientInfo, $this->request->data);
            if ($this->ProjectClientInfos->save($projectClientInfo)) {
                $this->Flash->success(__('The project client info has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The project client info could not be saved. Please, try again.'));
            }
        }
        $assocUsersProjects = $this->ProjectClientInfos->AssocUsersProjects->find('list', ['limit' => 200]);
        $this->set(compact('projectClientInfo', 'assocUsersProjects'));
        $this->set('_serialize', ['projectClientInfo']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Project Client Info id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $projectClientInfo = $this->ProjectClientInfos->get($id);
        if ($this->ProjectClientInfos->delete($projectClientInfo)) {
            $this->Flash->success(__('The project client info has been deleted.'));
        } else {
            $this->Flash->error(__('The project client info could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
