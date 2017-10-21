<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * AssocTeamsUsers Controller
 *
 * @property \App\Model\Table\AssocTeamsUsersTable $AssocTeamsUsers
 */
class AssocTeamsUsersController extends AppController
{

    public function initialize(){
        parent::initialize();
        $this->pageName = 'assocTeamsUsers';
    }
    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Teams', 'Users']
        ];
        $assocTeamsUsers = $this->paginate($this->AssocTeamsUsers);
        $pageName = $this->pageName;
        $this->set(compact('assocTeamsUsers', 'pageName'));
        $this->set('_serialize', ['assocTeamsUsers']);
    }

    /**
     * View method
     *
     * @param string|null $id Assoc Teams User id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $assocTeamsUser = $this->AssocTeamsUsers->get($id, [
            'contain' => ['Teams', 'Users']
        ]);
        $pageName = $this->pageName;
        $this->set(compact('pageName'));
        $this->set('assocTeamsUser', $assocTeamsUser);
        $this->set('_serialize', ['assocTeamsUser']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $assocTeamsUser = $this->AssocTeamsUsers->newEntity();
        if ($this->request->is('post')) {
            $assocTeamsUser = $this->AssocTeamsUsers->patchEntity($assocTeamsUser, $this->request->data);
            if (($this->request->data['accessLevel'] < 2)&&($this->AssocTeamsUsers->save($assocTeamsUser))) {
                $this->Flash->success(__('The assoc teams user has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The assoc teams user could not be saved. Please, try again.'));
            }
        }
        $teams = $this->AssocTeamsUsers->Teams->find('list', ['limit' => 200]);
        $users = $this->AssocTeamsUsers->Users->find('list', ['limit' => 200]);
        $pageName = $this->pageName;
        $this->set(compact('assocTeamsUser', 'teams', 'users', 'pageName'));
        $this->set('_serialize', ['assocTeamsUser']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Assoc Teams User id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $assocTeamsUser = $this->AssocTeamsUsers->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $userIdsOfThisTeam = $this->AssocTeamsUsers->getIdsUsersByTeamId($assocTeamsUser->team_id);
            $addToBase = false;
            if((in_array($this->request->data['user_id'], $userIdsOfThisTeam))&&($this->request->data['accessLevel'] > 1)){
                $addToBase = true;
            }elseif((!in_array($this->request->data['user_id'], $userIdsOfThisTeam))&&($this->request->data['accessLevel'] < 2)){
                $addToBase = false;
            }
            $assocTeamsUser = $this->AssocTeamsUsers->patchEntity($assocTeamsUser, $this->request->data);
            if (($addToBase)&&($this->AssocTeamsUsers->save($assocTeamsUser))) {
                $this->Flash->success(__('The assoc teams user has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The assoc teams user could not be saved. Please, try again.'));
            }
        }
        $teams = $this->AssocTeamsUsers->Teams->find('list', ['limit' => 200]);
        $users = $this->AssocTeamsUsers->Users->find('list', ['limit' => 200]);
        $pageName = $this->pageName;
        $this->set(compact('assocTeamsUser', 'teams', 'users', 'pageName'));
        $this->set('_serialize', ['assocTeamsUser']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Assoc Teams User id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $assocTeamsUser = $this->AssocTeamsUsers->get($id);
        if ($this->AssocTeamsUsers->delete($assocTeamsUser)) {
            $this->Flash->success(__('The assoc teams user has been deleted.'));
        } else {
            $this->Flash->error(__('The assoc teams user could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
