<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * ProjectEmployeeInfos Controller
 *
 * @property \App\Model\Table\ProjectEmployeeInfosTable $ProjectEmployeeInfos
 */
class ProjectEmployeeInfosController extends AppController
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
        $projectEmployeeInfos = $this->paginate($this->ProjectEmployeeInfos);

        $this->set(compact('projectEmployeeInfos'));
        $this->set('_serialize', ['projectEmployeeInfos']);
    }

    /**
     * View method
     *
     * @param string|null $id Project Employee Info id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $projectEmployeeInfo = $this->ProjectEmployeeInfos->get($id, [
            'contain' => ['AssocUsersProjects']
        ]);

        $this->set('projectEmployeeInfo', $projectEmployeeInfo);
        $this->set('_serialize', ['projectEmployeeInfo']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $projectEmployeeInfo = $this->ProjectEmployeeInfos->newEntity();
        if ($this->request->is('post')) {
            $projectEmployeeInfo = $this->ProjectEmployeeInfos->patchEntity($projectEmployeeInfo, $this->request->data);
            if ($this->ProjectEmployeeInfos->save($projectEmployeeInfo)) {
                $this->Flash->success(__('The project employee info has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The project employee info could not be saved. Please, try again.'));
            }
        }
        $assocUsersProjects = $this->ProjectEmployeeInfos->AssocUsersProjects->find('list', ['limit' => 200]);
        $this->set(compact('projectEmployeeInfo', 'assocUsersProjects'));
        $this->set('_serialize', ['projectEmployeeInfo']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Project Employee Info id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $projectEmployeeInfo = $this->ProjectEmployeeInfos->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $projectEmployeeInfo = $this->ProjectEmployeeInfos->patchEntity($projectEmployeeInfo, $this->request->data);
            if ($this->ProjectEmployeeInfos->save($projectEmployeeInfo)) {
                $this->Flash->success(__('The project employee info has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The project employee info could not be saved. Please, try again.'));
            }
        }
        $assocUsersProjects = $this->ProjectEmployeeInfos->AssocUsersProjects->find('list', ['limit' => 200]);
        $this->set(compact('projectEmployeeInfo', 'assocUsersProjects'));
        $this->set('_serialize', ['projectEmployeeInfo']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Project Employee Info id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $projectEmployeeInfo = $this->ProjectEmployeeInfos->get($id);
        if ($this->ProjectEmployeeInfos->delete($projectEmployeeInfo)) {
            $this->Flash->success(__('The project employee info has been deleted.'));
        } else {
            $this->Flash->error(__('The project employee info could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
