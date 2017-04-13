<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Actiondisciplinaires Controller
 *
 * @property \App\Model\Table\ActiondisciplinairesTable $Actiondisciplinaires
 */
class ActiondisciplinairesController extends AppController
{

    public function initialize() {
        parent::initialize();
        $this->pageName = 'Action disciplinaire';
    }
    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $actiondisciplinaires = $this->paginate($this->Actiondisciplinaires);

        $pageName = $this->pageName;
        $this->set(compact('actiondisciplinaires', 'pageName'));
        $this->set('_serialize', ['actiondisciplinaires']);
    }

    /**
     * View method
     *
     * @param string|null $id Actiondisciplinaire id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $actiondisciplinaire = $this->Actiondisciplinaires->get($id, [
            'contain' => []
        ]);

        $pageName = $this->pageName;
        $this->set(compact('pageName'));
        $this->set('actiondisciplinaire', $actiondisciplinaire);
        $this->set('_serialize', ['actiondisciplinaire']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $actiondisciplinaire = $this->Actiondisciplinaires->newEntity();
        if ($this->request->is('post')) {
            $actiondisciplinaire = $this->Actiondisciplinaires->patchEntity($actiondisciplinaire, $this->request->data);
            if ($this->Actiondisciplinaires->save($actiondisciplinaire)) {
                $this->Flash->success(__('The actiondisciplinaire has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The actiondisciplinaire could not be saved. Please, try again.'));
            }
        }
        
        $users = $this->Actiondisciplinaires->Users->find('list');
        $pageName = $this->pageName;
        $this->set(compact('actiondisciplinaire', 'pageName', 'users'));
        $this->set('_serialize', ['actiondisciplinaire']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Actiondisciplinaire id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $actiondisciplinaire = $this->Actiondisciplinaires->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $actiondisciplinaire = $this->Actiondisciplinaires->patchEntity($actiondisciplinaire, $this->request->data);
            if ($this->Actiondisciplinaires->save($actiondisciplinaire)) {
                $this->Flash->success(__('The actiondisciplinaire has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The actiondisciplinaire could not be saved. Please, try again.'));
            }
        }
        $pageName = $this->pageName;
        $this->set(compact('actiondisciplinaire', 'pageName'));
        $this->set('_serialize', ['actiondisciplinaire']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Actiondisciplinaire id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $actiondisciplinaire = $this->Actiondisciplinaires->get($id);
        if ($this->Actiondisciplinaires->delete($actiondisciplinaire)) {
            $this->Flash->success(__('The actiondisciplinaire has been deleted.'));
        } else {
            $this->Flash->error(__('The actiondisciplinaire could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
