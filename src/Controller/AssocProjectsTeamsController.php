<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * AssocProjectsTeams Controller
 *
 * @property \App\Model\Table\AssocProjectsTeamsTable $AssocProjectsTeams
 */
class AssocProjectsTeamsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Projects', 'Teams']
        ];
        $assocProjectsTeams = $this->paginate($this->AssocProjectsTeams);

        $this->set(compact('assocProjectsTeams'));
        $this->set('_serialize', ['assocProjectsTeams']);
    }

    /**
     * View method
     *
     * @param string|null $id Assoc Projects Team id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $assocProjectsTeam = $this->AssocProjectsTeams->get($id, [
            'contain' => ['Projects', 'Teams']
        ]);

        $this->set('assocProjectsTeam', $assocProjectsTeam);
        $this->set('_serialize', ['assocProjectsTeam']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $assocProjectsTeam = $this->AssocProjectsTeams->newEntity();
        if ($this->request->is('post')) {
            $assocProjectsTeam = $this->AssocProjectsTeams->patchEntity($assocProjectsTeam, $this->request->data);
            if ($this->AssocProjectsTeams->save($assocProjectsTeam)) {
                $this->Flash->success(__('The assoc projects team has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The assoc projects team could not be saved. Please, try again.'));
            }
        }
        $projects = $this->AssocProjectsTeams->Projects->find('list', ['limit' => 200]);
        $teams = $this->AssocProjectsTeams->Teams->find('list', ['limit' => 200]);
        $this->set(compact('assocProjectsTeam', 'projects', 'teams'));
        $this->set('_serialize', ['assocProjectsTeam']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Assoc Projects Team id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $assocProjectsTeam = $this->AssocProjectsTeams->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $assocProjectsTeam = $this->AssocProjectsTeams->patchEntity($assocProjectsTeam, $this->request->data);
            if ($this->AssocProjectsTeams->save($assocProjectsTeam)) {
                $this->Flash->success(__('The assoc projects team has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The assoc projects team could not be saved. Please, try again.'));
            }
        }
        $projects = $this->AssocProjectsTeams->Projects->find('list', ['limit' => 200]);
        $teams = $this->AssocProjectsTeams->Teams->find('list', ['limit' => 200]);
        $this->set(compact('assocProjectsTeam', 'projects', 'teams'));
        $this->set('_serialize', ['assocProjectsTeam']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Assoc Projects Team id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $assocProjectsTeam = $this->AssocProjectsTeams->get($id);
        if ($this->AssocProjectsTeams->delete($assocProjectsTeam)) {
            $this->Flash->success(__('The assoc projects team has been deleted.'));
        } else {
            $this->Flash->error(__('The assoc projects team could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
