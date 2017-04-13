<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * AssocTeamsMembers Controller
 *
 * @property \App\Model\Table\AssocTeamsMembersTable $AssocTeamsMembers
 */
class AssocTeamsMembersController extends AppController
{

    public function initialize() {
        parent::initialize();
        $this->pageName = 'assocTeamsMembers';
    }
    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Teams', 'Members']
        ];
        $assocTeamsMembers = $this->paginate($this->AssocTeamsMembers);
        $pageName = $this->pageName;
        $this->set(compact('assocTeamsMembers', 'pageName'));
        $this->set('_serialize', ['assocTeamsMembers']);
    }

    /**
     * View method
     *
     * @param string|null $id Assoc Teams Member id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $assocTeamsMember = $this->AssocTeamsMembers->get($id, [
            'contain' => ['Teams', 'Members']
        ]);
        $pageName = $this->pageName;
        $this->set(compact('pageName'));
        $this->set('assocTeamsMember', $assocTeamsMember);
        $this->set('_serialize', ['assocTeamsMember']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $assocTeamsMember = $this->AssocTeamsMembers->newEntity();
        if ($this->request->is('post')) {
            $assocTeamsMember = $this->AssocTeamsMembers->patchEntity($assocTeamsMember, $this->request->data);
            if ($this->AssocTeamsMembers->save($assocTeamsMember)) {
                $this->Flash->success(__('The assoc teams member has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The assoc teams member could not be saved. Please, try again.'));
            }
        }
        $teams = $this->AssocTeamsMembers->Teams->find('list', ['limit' => 200]);
        $members = $this->AssocTeamsMembers->Members->find('list', ['limit' => 200]);
        $pageName = $this->pageName;
        $this->set(compact('assocTeamsMember', 'teams', 'members', 'pageName'));
        $this->set('_serialize', ['assocTeamsMember']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Assoc Teams Member id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $assocTeamsMember = $this->AssocTeamsMembers->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $assocTeamsMember = $this->AssocTeamsMembers->patchEntity($assocTeamsMember, $this->request->data);
            if ($this->AssocTeamsMembers->save($assocTeamsMember)) {
                $this->Flash->success(__('The assoc teams member has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The assoc teams member could not be saved. Please, try again.'));
            }
        }
        $teams = $this->AssocTeamsMembers->Teams->find('list', ['limit' => 200]);
        $members = $this->AssocTeamsMembers->Members->find('list', ['limit' => 200]);
        $pageName = $this->pageName;
        $this->set(compact('assocTeamsMember', 'teams', 'members', 'pageName'));
        $this->set('_serialize', ['assocTeamsMember']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Assoc Teams Member id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $assocTeamsMember = $this->AssocTeamsMembers->get($id);
        if ($this->AssocTeamsMembers->delete($assocTeamsMember)) {
            $this->Flash->success(__('The assoc teams member has been deleted.'));
        } else {
            $this->Flash->error(__('The assoc teams member could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
