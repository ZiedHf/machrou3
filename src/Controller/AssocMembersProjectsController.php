<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * AssocMembersProjects Controller
 *
 * @property \App\Model\Table\AssocMembersProjectsTable $AssocMembersProjects
 */
class AssocMembersProjectsController extends AppController
{

    public function initialize() {
        parent::initialize();
        $this->pageName = 'assocMembersProjects';
    }
    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Members', 'Projects']
        ];
        $assocMembersProjects = $this->paginate($this->AssocMembersProjects);
        $pageName = $this->pageName;
        $this->set(compact('assocMembersProjects', 'pageName'));
        $this->set('_serialize', ['assocMembersProjects']);
    }

    /**
     * View method
     *
     * @param string|null $id Assoc Members Project id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $assocMembersProject = $this->AssocMembersProjects->get($id, [
            'contain' => ['Members', 'Projects']
        ]);
        $pageName = $this->pageName;
        $this->set(compact('pageName'));
        $this->set('assocMembersProject', $assocMembersProject);
        $this->set('_serialize', ['assocMembersProject']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $assocMembersProject = $this->AssocMembersProjects->newEntity();
        if ($this->request->is('post')) {
            $assocMembersProject = $this->AssocMembersProjects->patchEntity($assocMembersProject, $this->request->data);
            if ($this->AssocMembersProjects->save($assocMembersProject)) {
                $this->Flash->success(__('The assoc members project has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The assoc members project could not be saved. Please, try again.'));
            }
        }
        $members = $this->AssocMembersProjects->Members->find('list', ['limit' => 200]);
        $projects = $this->AssocMembersProjects->Projects->find('list', ['limit' => 200]);
        $pageName = $this->pageName;
        $this->set(compact('assocMembersProject', 'members', 'projects', 'pageName'));
        $this->set('_serialize', ['assocMembersProject']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Assoc Members Project id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $assocMembersProject = $this->AssocMembersProjects->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $assocMembersProject = $this->AssocMembersProjects->patchEntity($assocMembersProject, $this->request->data);
            if ($this->AssocMembersProjects->save($assocMembersProject)) {
                $this->Flash->success(__('The assoc members project has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The assoc members project could not be saved. Please, try again.'));
            }
        }
        $members = $this->AssocMembersProjects->Members->find('list', ['limit' => 200]);
        $projects = $this->AssocMembersProjects->Projects->find('list', ['limit' => 200]);
        $pageName = $this->pageName;
        $this->set(compact('assocMembersProject', 'members', 'projects', 'pageName'));
        $this->set('_serialize', ['assocMembersProject']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Assoc Members Project id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $assocMembersProject = $this->AssocMembersProjects->get($id);
        if ($this->AssocMembersProjects->delete($assocMembersProject)) {
            $this->Flash->success(__('The assoc members project has been deleted.'));
        } else {
            $this->Flash->error(__('The assoc members project could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
