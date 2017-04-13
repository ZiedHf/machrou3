<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * AssocTeamsCriterions Controller
 *
 * @property \App\Model\Table\AssocTeamsCriterionsTable $AssocTeamsCriterions
 */
class AssocTeamsCriterionsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Teams', 'Criterions']
        ];
        $assocTeamsCriterions = $this->paginate($this->AssocTeamsCriterions);

        $this->set(compact('assocTeamsCriterions'));
        $this->set('_serialize', ['assocTeamsCriterions']);
    }

    /**
     * View method
     *
     * @param string|null $id Assoc Teams Criterion id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $assocTeamsCriterion = $this->AssocTeamsCriterions->get($id, [
            'contain' => ['Teams', 'Criterions']
        ]);

        $this->set('assocTeamsCriterion', $assocTeamsCriterion);
        $this->set('_serialize', ['assocTeamsCriterion']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $assocTeamsCriterion = $this->AssocTeamsCriterions->newEntity();
        if ($this->request->is('post')) {
            $assocTeamsCriterion = $this->AssocTeamsCriterions->patchEntity($assocTeamsCriterion, $this->request->data);
            if ($this->AssocTeamsCriterions->save($assocTeamsCriterion)) {
                $this->Flash->success(__('The assoc teams criterion has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The assoc teams criterion could not be saved. Please, try again.'));
            }
        }
        $teams = $this->AssocTeamsCriterions->Teams->find('list', ['limit' => 200]);
        $criterions = $this->AssocTeamsCriterions->Criterions->find('list', ['limit' => 200]);
        $this->set(compact('assocTeamsCriterion', 'teams', 'criterions'));
        $this->set('_serialize', ['assocTeamsCriterion']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Assoc Teams Criterion id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $assocTeamsCriterion = $this->AssocTeamsCriterions->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $assocTeamsCriterion = $this->AssocTeamsCriterions->patchEntity($assocTeamsCriterion, $this->request->data);
            if ($this->AssocTeamsCriterions->save($assocTeamsCriterion)) {
                $this->Flash->success(__('The assoc teams criterion has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The assoc teams criterion could not be saved. Please, try again.'));
            }
        }
        $teams = $this->AssocTeamsCriterions->Teams->find('list', ['limit' => 200]);
        $criterions = $this->AssocTeamsCriterions->Criterions->find('list', ['limit' => 200]);
        $this->set(compact('assocTeamsCriterion', 'teams', 'criterions'));
        $this->set('_serialize', ['assocTeamsCriterion']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Assoc Teams Criterion id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $assocTeamsCriterion = $this->AssocTeamsCriterions->get($id);
        if ($this->AssocTeamsCriterions->delete($assocTeamsCriterion)) {
            $this->Flash->success(__('The assoc teams criterion has been deleted.'));
        } else {
            $this->Flash->error(__('The assoc teams criterion could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
