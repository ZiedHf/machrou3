<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * AssocCompaniesMembers Controller
 *
 * @property \App\Model\Table\AssocCompaniesMembersTable $AssocCompaniesMembers
 */
class AssocCompaniesMembersController extends AppController
{

    public function initialize() {
        parent::initialize();
        $this->pageName = "assocCompaniesMembers";
    }
    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Members', 'Companies']
        ];
        $assocCompaniesMembers = $this->paginate($this->AssocCompaniesMembers);
        $pageName = $this->pageName;
        $this->set(compact('assocCompaniesMembers', 'pageName'));
        $this->set('_serialize', ['assocCompaniesMembers']);
    }

    /**
     * View method
     *
     * @param string|null $id Assoc Companies Member id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $assocCompaniesMember = $this->AssocCompaniesMembers->get($id, [
            'contain' => ['Members', 'Companies']
        ]);
        $pageName = $this->pageName;
        $this->set(compact('pageName'));
        $this->set('assocCompaniesMember', $assocCompaniesMember);
        $this->set('_serialize', ['assocCompaniesMember']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $assocCompaniesMember = $this->AssocCompaniesMembers->newEntity();
        if ($this->request->is('post')) {
            $assocCompaniesMember = $this->AssocCompaniesMembers->patchEntity($assocCompaniesMember, $this->request->data);
            if ($this->AssocCompaniesMembers->save($assocCompaniesMember)) {
                $this->Flash->success(__('The assoc companies member has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The assoc companies member could not be saved. Please, try again.'));
            }
        }
        $members = $this->AssocCompaniesMembers->Members->find('list');
        $companies = $this->AssocCompaniesMembers->Companies->find('list');
        $pageName = $this->pageName;
        $this->set(compact('assocCompaniesMember', 'members', 'companies', 'pageName'));
        $this->set('_serialize', ['assocCompaniesMember']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Assoc Companies Member id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $assocCompaniesMember = $this->AssocCompaniesMembers->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $assocCompaniesMember = $this->AssocCompaniesMembers->patchEntity($assocCompaniesMember, $this->request->data);
            if ($this->AssocCompaniesMembers->save($assocCompaniesMember)) {
                $this->Flash->success(__('The assoc companies member has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The assoc companies member could not be saved. Please, try again.'));
            }
        }
        $members = $this->AssocCompaniesMembers->Members->find('list');
        $companies = $this->AssocCompaniesMembers->Companies->find('list');
        $pageName = $this->pageName;
        $this->set(compact('assocCompaniesMember', 'members', 'companies', 'pageName'));
        $this->set('_serialize', ['assocCompaniesMember']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Assoc Companies Member id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $assocCompaniesMember = $this->AssocCompaniesMembers->get($id);
        if ($this->AssocCompaniesMembers->delete($assocCompaniesMember)) {
            $this->Flash->success(__('The assoc companies member has been deleted.'));
        } else {
            $this->Flash->error(__('The assoc companies member could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
