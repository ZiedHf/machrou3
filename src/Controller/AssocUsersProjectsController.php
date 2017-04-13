<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * AssocUsersProjects Controller
 *
 * @property \App\Model\Table\AssocUsersProjectsTable $AssocUsersProjects
 */
class AssocUsersProjectsController extends AppController
{

    public function initialize() {
        parent::initialize();
        $this->pageName = 'assocUsersProjects';
    }
    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users', 'Projects']
        ];
        $assocUsersProjects = $this->paginate($this->AssocUsersProjects);
        $pageName = $this->pageName;
        $this->set(compact('assocUsersProjects', 'pageName'));
        //$this->set('_serialize', ['assocUsersProjects']);
    }

    /**
     * View method
     *
     * @param string|null $id Assoc Users Project id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $assocUsersProject = $this->AssocUsersProjects->get($id, [
            'contain' => ['Users', 'Projects']
        ]);
        $pageName = $this->pageName;
        $this->set(compact('pageName'));
        $this->set('assocUsersProject', $assocUsersProject);
        $this->set('_serialize', ['assocUsersProject']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $assocUsersProject = $this->AssocUsersProjects->newEntity();
        if ($this->request->is('post')) {
            $assocUsersProject = $this->AssocUsersProjects->patchEntity($assocUsersProject, $this->request->data);
            
            if (($this->request->data['accessLevel'] < 2)&&($this->AssocUsersProjects->save($assocUsersProject))) {
                $this->Flash->success(__('The assoc users project has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The assoc users project could not be saved. Please, try again.'));
            }
        }
        $users = $this->AssocUsersProjects->Users->find('list');
        $projects = $this->AssocUsersProjects->Projects->find('list');
        $pageName = $this->pageName;
        $this->set(compact('assocUsersProject', 'users', 'projects', 'pageName'));
        $this->set('_serialize', ['assocUsersProject']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Assoc Users Project id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $assocUsersProject = $this->AssocUsersProjects->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $userIdsOfThisProject = $this->AssocUsersProjects->getIdsUsersByprojectId($assocUsersProject->project_id);
            $addToBase = false;
            if(((in_array($this->request->data['user_id'], $userIdsOfThisProject))&&($this->request->data['accessLevel'] > 1)&&($this->request->data['accessLevel'] < 5))
                    ||
                ((!in_array($this->request->data['user_id'], $userIdsOfThisProject))&&($this->request->data['accessLevel'] < 2))){
                $addToBase = true;
            }

            $assocUsersProject = $this->AssocUsersProjects->patchEntity($assocUsersProject, $this->request->data);
            if (($addToBase)&&($this->AssocUsersProjects->save($assocUsersProject))) {
                $this->Flash->success(__('The assoc users project has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The assoc users project could not be saved. Please, try again.'));
            }
        }
        $users = $this->AssocUsersProjects->Users->find('list');
        $projects = $this->AssocUsersProjects->Projects->find('list');
        $pageName = $this->pageName;
        $this->set(compact('assocUsersProject', 'users', 'projects', 'pageName'));
        $this->set('_serialize', ['assocUsersProject']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Assoc Users Project id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $assocUsersProject = $this->AssocUsersProjects->get($id);
        if ($this->AssocUsersProjects->delete($assocUsersProject)) {
            $this->Flash->success(__('The assoc users project has been deleted.'));
        } else {
            $this->Flash->error(__('The assoc users project could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
