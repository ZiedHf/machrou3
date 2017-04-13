<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Rapports Controller
 *
 * @property \App\Model\Table\RapportsTable $Rapports
 */
class RapportsController extends AppController
{

    public function initialize() {
        parent::initialize();
        $this->pageName = 'Rapports';
    }
    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users']
        ];
        $rapports = $this->paginate($this->Rapports);

        $pageName = $this->pageName;
        $this->set(compact('rapports', 'pageName'));
        $this->set('_serialize', ['rapports']);
    }

    /**
     * View method
     *
     * @param string|null $id Rapport id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $rapport = $this->Rapports->get($id, [
            'contain' => ['Users']
        ]);

        $pageName = $this->pageName;
        $this->set(compact('pageName'));
        $this->set('rapport', $rapport);
        $this->set('_serialize', ['rapport']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $rapport = $this->Rapports->newEntity();
        if ($this->request->is('post')) {
            $rapport = $this->Rapports->patchEntity($rapport, $this->request->data);
            if ($this->Rapports->save($rapport)) {
                $this->Flash->success(__('has been saved.', ['Le ', 'rapport', '']));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('could not be saved. Please, try again.', ['Le ', 'rapport', '']));
            }
        }
        $users = $this->Rapports->Users->find('list', ['limit' => 200]);
        
        $pageName = $this->pageName;
        $this->set(compact('rapport', 'users', 'pageName'));
        $this->set('_serialize', ['rapport']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Rapport id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $rapport = $this->Rapports->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $rapport = $this->Rapports->patchEntity($rapport, $this->request->data);
            if ($this->Rapports->save($rapport)) {
                $this->Flash->success(__('has been saved.', ['Le ', 'rapport', '']));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('could not be saved. Please, try again.', ['Le ', 'rapport', '']));
            }
        }
        $users = $this->Rapports->Users->find('list', ['limit' => 200]);
        
        $pageName = $this->pageName;
        $this->set(compact('rapport', 'users', 'pageName'));
        $this->set('_serialize', ['rapport']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Rapport id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $rapport = $this->Rapports->get($id);
        if ($this->Rapports->delete($rapport)) {
            $this->Flash->success(__('has been deleted.', ['Le ', 'rapport', '']));
        } else {
            $this->Flash->error(__('could not be deleted. Please, try again.', ['Le ', 'rapport', '']));
        }

        return $this->redirect(['action' => 'index']);
    }
}
