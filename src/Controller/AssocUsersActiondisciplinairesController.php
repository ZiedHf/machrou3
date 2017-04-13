<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * AssocUsersActiondisciplinaires Controller
 *
 * @property \App\Model\Table\AssocUsersActiondisciplinairesTable $AssocUsersActiondisciplinaires
 */
class AssocUsersActiondisciplinairessController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Actiondisciplinaires', 'Users']
        ];
        $AssocUsersActiondisciplinaires = $this->paginate($this->AssocUsersActiondisciplinaires);

        $this->set(compact('AssocUsersActiondisciplinaires'));
        $this->set('_serialize', ['AssocUsersActiondisciplinaires']);
    }

    /**
     * View method
     *
     * @param string|null $id Assoc Users Actiondisciplinaire id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $AssocUsersActiondisciplinaires = $this->AssocUsersActiondisciplinaires->get($id, [
            'contain' => ['Actiondisciplinaires', 'Users']
        ]);

        $this->set('AssocUsersActiondisciplinaires', $AssocUsersActiondisciplinaires);
        $this->set('_serialize', ['AssocUsersActiondisciplinaires']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $AssocUsersActiondisciplinaires = $this->AssocUsersActiondisciplinaires->newEntity();
        if ($this->request->is('post')) {
            $AssocUsersActiondisciplinaires = $this->AssocUsersActiondisciplinaires->patchEntity($AssocUsersActiondisciplinaires, $this->request->data);
            if ($this->AssocUsersActiondisciplinaires->save($AssocUsersActiondisciplinaires)) {
                $this->Flash->success(__('The assoc users actiondisciplinaire has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The assoc users actiondisciplinaire could not be saved. Please, try again.'));
            }
        }
        $actiondisciplinaires = $this->AssocUsersActiondisciplinaires->Actiondisciplinaires->find('list', ['limit' => 200]);
        $users = $this->AssocUsersActiondisciplinaires->Users->find('list', ['limit' => 200]);
        $this->set(compact('AssocUsersActiondisciplinaires', 'actiondisciplinaires', 'users'));
        $this->set('_serialize', ['AssocUsersActiondisciplinaires']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Assoc Users Actiondisciplinaire id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $AssocUsersActiondisciplinaires = $this->AssocUsersActiondisciplinaires->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $AssocUsersActiondisciplinaires = $this->AssocUsersActiondisciplinaires->patchEntity($AssocUsersActiondisciplinaires, $this->request->data);
            if ($this->AssocUsersActiondisciplinaires->save($AssocUsersActiondisciplinaires)) {
                $this->Flash->success(__('The assoc users actiondisciplinaire has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The assoc users actiondisciplinaire could not be saved. Please, try again.'));
            }
        }
        $actiondisciplinaires = $this->AssocUsersActiondisciplinaires->Actiondisciplinaires->find('list', ['limit' => 200]);
        $users = $this->AssocUsersActiondisciplinaires->Users->find('list', ['limit' => 200]);
        $this->set(compact('AssocUsersActiondisciplinaires', 'actiondisciplinaires', 'users'));
        $this->set('_serialize', ['AssocUsersActiondisciplinaires']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Assoc Users Actiondisciplinaire id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $AssocUsersActiondisciplinaires = $this->AssocUsersActiondisciplinaires->get($id);
        if ($this->AssocUsersActiondisciplinaires->delete($AssocUsersActiondisciplinaires)) {
            $this->Flash->success(__('The assoc users actiondisciplinaire has been deleted.'));
        } else {
            $this->Flash->error(__('The assoc users actiondisciplinaire could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
