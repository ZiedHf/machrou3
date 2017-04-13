<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * AssocDepartementsUsers Controller
 *
 * @property \App\Model\Table\AssocDepartementsUsersTable $AssocDepartementsUsers
 */
class AssocDepartementsUsersController extends AppController
{

    public function initialize(){
        parent::initialize();
        $this->pageName = 'assocDepartementsUsers';
    }
    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Departements', 'Users']
        ];
        $assocDepartementsUsers = $this->paginate($this->AssocDepartementsUsers);
        $pageName = $this->pageName;
        $this->set(compact('assocDepartementsUsers', 'pageName'));
        $this->set('_serialize', ['assocDepartementsUsers']);
    }

    /**
     * View method
     *
     * @param string|null $id Assoc Departements User id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $assocDepartementsUser = $this->AssocDepartementsUsers->get($id, [
            'contain' => ['Departements', 'Users']
        ]);
        $pageName = $this->pageName;
        $this->set(compact('pageName'));
        $this->set('assocDepartementsUser', $assocDepartementsUser);
        $this->set('_serialize', ['assocDepartementsUser']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $assocDepartementsUser = $this->AssocDepartementsUsers->newEntity();
        if ($this->request->is('post')) {
            $assocDepartementsUser = $this->AssocDepartementsUsers->patchEntity($assocDepartementsUser, $this->request->data);
            if ($this->AssocDepartementsUsers->save($assocDepartementsUser)) {
                $this->Flash->success(__('The assoc departements user has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The assoc departements user could not be saved. Please, try again.'));
            }
        }
        $departements = $this->AssocDepartementsUsers->Departements->find('list', ['limit' => 200]);
        $users = $this->AssocDepartementsUsers->Users->find('list', ['limit' => 200]);
        $pageName = $this->pageName;
        $this->set(compact('assocDepartementsUser', 'departements', 'users', 'pageName'));
        $this->set('_serialize', ['assocDepartementsUser']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Assoc Departements User id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $assocDepartementsUser = $this->AssocDepartementsUsers->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $assocDepartementsUser = $this->AssocDepartementsUsers->patchEntity($assocDepartementsUser, $this->request->data);
            if ($this->AssocDepartementsUsers->save($assocDepartementsUser)) {
                $this->Flash->success(__('The assoc departements user has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The assoc departements user could not be saved. Please, try again.'));
            }
        }
        $departements = $this->AssocDepartementsUsers->Departements->find('list', ['limit' => 200]);
        $users = $this->AssocDepartementsUsers->Users->find('list', ['limit' => 200]);
        $pageName = $this->pageName;
        $this->set(compact('assocDepartementsUser', 'departements', 'users', 'pageName'));
        $this->set('_serialize', ['assocDepartementsUser']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Assoc Departements User id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $assocDepartementsUser = $this->AssocDepartementsUsers->get($id);
        if ($this->AssocDepartementsUsers->delete($assocDepartementsUser)) {
            $this->Flash->success(__('The assoc departements user has been deleted.'));
        } else {
            $this->Flash->error(__('The assoc departements user could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
