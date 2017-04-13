<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * AssocCompaniesUsers Controller
 *
 * @property \App\Model\Table\AssocCompaniesUsersTable $AssocCompaniesUsers
 */
class AssocCompaniesUsersController extends AppController
{

    public function initialize(){
        parent::initialize();
        $this->pageName = 'assocCompaniesUsers';
    }
    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users', 'Companies']
        ];
        $assocCompaniesUsers = $this->paginate($this->AssocCompaniesUsers);
        $pageName = $this->pageName;
        $this->set(compact('assocCompaniesUsers', 'pageName'));
        $this->set('_serialize', ['assocCompaniesUsers']);
    }

    /**
     * View method
     *
     * @param string|null $id Assoc Companies User id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $assocCompaniesUser = $this->AssocCompaniesUsers->get($id, [
            'contain' => ['Users', 'Companies']
        ]);
        $pageName = $this->pageName;
        $this->set(compact('pageName'));
        $this->set('assocCompaniesUser', $assocCompaniesUser);
        $this->set('_serialize', ['assocCompaniesUser']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $assocCompaniesUser = $this->AssocCompaniesUsers->newEntity();
        if ($this->request->is('post')) {
            $assocCompaniesUser = $this->AssocCompaniesUsers->patchEntity($assocCompaniesUser, $this->request->data);
            if ($this->AssocCompaniesUsers->save($assocCompaniesUser)) {
                $this->Flash->success(__('The assoc companies user has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The assoc companies user could not be saved. Please, try again.'));
            }
        }
        $users = $this->AssocCompaniesUsers->Users->find('list', ['limit' => 200]);
        $companies = $this->AssocCompaniesUsers->Companies->find('list', ['limit' => 200]);
        $pageName = $this->pageName;
        $this->set(compact('assocCompaniesUser', 'users', 'companies', 'pageName'));
        $this->set('_serialize', ['assocCompaniesUser']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Assoc Companies User id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $assocCompaniesUser = $this->AssocCompaniesUsers->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $assocCompaniesUser = $this->AssocCompaniesUsers->patchEntity($assocCompaniesUser, $this->request->data);
            if ($this->AssocCompaniesUsers->save($assocCompaniesUser)) {
                $this->Flash->success(__('The assoc companies user has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The assoc companies user could not be saved. Please, try again.'));
            }
        }
        $users = $this->AssocCompaniesUsers->Users->find('list', ['limit' => 200]);
        $companies = $this->AssocCompaniesUsers->Companies->find('list', ['limit' => 200]);
        $pageName = $this->pageName;
        $this->set(compact('assocCompaniesUser', 'users', 'companies', 'pageName'));
        $this->set('_serialize', ['assocCompaniesUser']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Assoc Companies User id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $assocCompaniesUser = $this->AssocCompaniesUsers->get($id);
        if ($this->AssocCompaniesUsers->delete($assocCompaniesUser)) {
            $this->Flash->success(__('The assoc companies user has been deleted.'));
        } else {
            $this->Flash->error(__('The assoc companies user could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
