<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * AssocDepartementsMembers Controller
 *
 * @property \App\Model\Table\AssocDepartementsMembersTable $AssocDepartementsMembers
 */
class AssocDepartementsMembersController extends AppController
{

    public function initialize() {
        parent::initialize();
        $this->pageName = 'assocDepartementsMembers';
    }
    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Departements', 'Members']
        ];
        $assocDepartementsMembers = $this->paginate($this->AssocDepartementsMembers);
        $pageName = $this->pageName;
        $this->set(compact('assocDepartementsMembers', 'pageName'));
        $this->set('_serialize', ['assocDepartementsMembers']);
    }

    /**
     * View method
     *
     * @param string|null $id Assoc Departements Member id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $assocDepartementsMember = $this->AssocDepartementsMembers->get($id, [
            'contain' => ['Departements', 'Members']
        ]);
        $pageName = $this->pageName;
        $this->set(compact('pageName'));
        $this->set('assocDepartementsMember', $assocDepartementsMember);
        $this->set('_serialize', ['assocDepartementsMember']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $assocDepartementsMember = $this->AssocDepartementsMembers->newEntity();
        if ($this->request->is('post')) {
            $assocDepartementsMember = $this->AssocDepartementsMembers->patchEntity($assocDepartementsMember, $this->request->data);
            if ($this->AssocDepartementsMembers->save($assocDepartementsMember)) {
                $this->Flash->success(__('The assoc departements member has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The assoc departements member could not be saved. Please, try again.'));
            }
        }
        $departements = $this->AssocDepartementsMembers->Departements->find('list', ['limit' => 200]);
        $members = $this->AssocDepartementsMembers->Members->find('list', ['limit' => 200]);
        $pageName = $this->pageName;
        $this->set(compact('assocDepartementsMember', 'departements', 'members', 'pageName'));
        $this->set('_serialize', ['assocDepartementsMember']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Assoc Departements Member id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $assocDepartementsMember = $this->AssocDepartementsMembers->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $assocDepartementsMember = $this->AssocDepartementsMembers->patchEntity($assocDepartementsMember, $this->request->data);
            if ($this->AssocDepartementsMembers->save($assocDepartementsMember)) {
                $this->Flash->success(__('The assoc departements member has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The assoc departements member could not be saved. Please, try again.'));
            }
        }
        $departements = $this->AssocDepartementsMembers->Departements->find('list', ['limit' => 200]);
        $members = $this->AssocDepartementsMembers->Members->find('list', ['limit' => 200]);
        $pageName = $this->pageName;
        $this->set(compact('assocDepartementsMember', 'departements', 'members', 'pageName'));
        $this->set('_serialize', ['assocDepartementsMember']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Assoc Departements Member id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $assocDepartementsMember = $this->AssocDepartementsMembers->get($id);
        if ($this->AssocDepartementsMembers->delete($assocDepartementsMember)) {
            $this->Flash->success(__('The assoc departements member has been deleted.'));
        } else {
            $this->Flash->error(__('The assoc departements member could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
