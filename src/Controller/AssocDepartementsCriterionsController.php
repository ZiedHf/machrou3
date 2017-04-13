<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * AssocDepartementsCriterions Controller
 *
 * @property \App\Model\Table\AssocDepartementsCriterionsTable $AssocDepartementsCriterions
 */
class AssocDepartementsCriterionsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Departements', 'Criterions']
        ];
        $assocDepartementsCriterions = $this->paginate($this->AssocDepartementsCriterions);

        $this->set(compact('assocDepartementsCriterions'));
        $this->set('_serialize', ['assocDepartementsCriterions']);
    }

    /**
     * View method
     *
     * @param string|null $id Assoc Departements Criterion id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $assocDepartementsCriterion = $this->AssocDepartementsCriterions->get($id, [
            'contain' => ['Departements', 'Criterions']
        ]);

        $this->set('assocDepartementsCriterion', $assocDepartementsCriterion);
        $this->set('_serialize', ['assocDepartementsCriterion']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $assocDepartementsCriterion = $this->AssocDepartementsCriterions->newEntity();
        if ($this->request->is('post')) {
            $assocDepartementsCriterion = $this->AssocDepartementsCriterions->patchEntity($assocDepartementsCriterion, $this->request->data);
            if ($this->AssocDepartementsCriterions->save($assocDepartementsCriterion)) {
                $this->Flash->success(__('The assoc departements criterion has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The assoc departements criterion could not be saved. Please, try again.'));
            }
        }
        $departements = $this->AssocDepartementsCriterions->Departements->find('list', ['limit' => 200]);
        $criterions = $this->AssocDepartementsCriterions->Criterions->find('list', ['limit' => 200]);
        $this->set(compact('assocDepartementsCriterion', 'departements', 'criterions'));
        $this->set('_serialize', ['assocDepartementsCriterion']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Assoc Departements Criterion id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $assocDepartementsCriterion = $this->AssocDepartementsCriterions->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $assocDepartementsCriterion = $this->AssocDepartementsCriterions->patchEntity($assocDepartementsCriterion, $this->request->data);
            if ($this->AssocDepartementsCriterions->save($assocDepartementsCriterion)) {
                $this->Flash->success(__('The assoc departements criterion has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The assoc departements criterion could not be saved. Please, try again.'));
            }
        }
        $departements = $this->AssocDepartementsCriterions->Departements->find('list', ['limit' => 200]);
        $criterions = $this->AssocDepartementsCriterions->Criterions->find('list', ['limit' => 200]);
        $this->set(compact('assocDepartementsCriterion', 'departements', 'criterions'));
        $this->set('_serialize', ['assocDepartementsCriterion']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Assoc Departements Criterion id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $assocDepartementsCriterion = $this->AssocDepartementsCriterions->get($id);
        if ($this->AssocDepartementsCriterions->delete($assocDepartementsCriterion)) {
            $this->Flash->success(__('The assoc departements criterion has been deleted.'));
        } else {
            $this->Flash->error(__('The assoc departements criterion could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
