<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * AssocProjectsCriterions Controller
 *
 * @property \App\Model\Table\AssocProjectsCriterionsTable $AssocProjectsCriterions
 */
class AssocProjectsCriterionsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Projects', 'Criterions']
        ];
        $assocProjectsCriterions = $this->paginate($this->AssocProjectsCriterions);

        $this->set(compact('assocProjectsCriterions'));
        $this->set('_serialize', ['assocProjectsCriterions']);
    }

    /**
     * View method
     *
     * @param string|null $id Assoc Projects Criterion id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $assocProjectsCriterion = $this->AssocProjectsCriterions->get($id, [
            'contain' => ['Projects', 'Criterions']
        ]);

        $this->set('assocProjectsCriterion', $assocProjectsCriterion);
        $this->set('_serialize', ['assocProjectsCriterion']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $assocProjectsCriterion = $this->AssocProjectsCriterions->newEntity();
        if ($this->request->is('post')) {
            $assocProjectsCriterion = $this->AssocProjectsCriterions->patchEntity($assocProjectsCriterion, $this->request->data);
            if ($this->AssocProjectsCriterions->save($assocProjectsCriterion)) {
                $this->Flash->success(__('The assoc projects criterion has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The assoc projects criterion could not be saved. Please, try again.'));
            }
        }
        $projects = $this->AssocProjectsCriterions->Projects->find('list', ['limit' => 200]);
        $criterions = $this->AssocProjectsCriterions->Criterions->find('list', ['limit' => 200]);
        $this->set(compact('assocProjectsCriterion', 'projects', 'criterions'));
        $this->set('_serialize', ['assocProjectsCriterion']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Assoc Projects Criterion id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $assocProjectsCriterion = $this->AssocProjectsCriterions->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $assocProjectsCriterion = $this->AssocProjectsCriterions->patchEntity($assocProjectsCriterion, $this->request->data);
            if ($this->AssocProjectsCriterions->save($assocProjectsCriterion)) {
                $this->Flash->success(__('The assoc projects criterion has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The assoc projects criterion could not be saved. Please, try again.'));
            }
        }
        $projects = $this->AssocProjectsCriterions->Projects->find('list', ['limit' => 200]);
        $criterions = $this->AssocProjectsCriterions->Criterions->find('list', ['limit' => 200]);
        $this->set(compact('assocProjectsCriterion', 'projects', 'criterions'));
        $this->set('_serialize', ['assocProjectsCriterion']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Assoc Projects Criterion id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $assocProjectsCriterion = $this->AssocProjectsCriterions->get($id);
        if ($this->AssocProjectsCriterions->delete($assocProjectsCriterion)) {
            $this->Flash->success(__('The assoc projects criterion has been deleted.'));
        } else {
            $this->Flash->error(__('The assoc projects criterion could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
