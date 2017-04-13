<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * ProjectStages Controller
 *
 * @property \App\Model\Table\ProjectStagesTable $ProjectStages
 */
class ProjectStagesController extends AppController
{

    public function initialize(){
        parent::initialize();
        $this->pageName = 'ProjectStages';
    }
    
    public function isAuthorized($user = null){
        if(parent::isAuthorized($user)){
            return true;
        }
        
        if((isset($user['type']))&&(in_array($user['type'], ['user', 'member']))){
            if((isset($user['projectstages_manager']))&&($user['projectstages_manager'])){
                return true;
            }
        }
        return false;
    }
    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        //debug($this->ProjectStages->getStagesByOrder());die();
        $this->paginate = ['maxLimit' => 15, 'order' => ['order_stage' => 'ASC']];
        $projectStages = $this->paginate($this->ProjectStages);
        $pageName = $this->pageName;
        $this->set(compact('projectStages', 'pageName'));
        $this->set('_serialize', ['projectStages']);
    }

    /**
     * View method
     *
     * @param string|null $id Project Stage id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $projectStage = $this->ProjectStages->get($id, [
            'contain' => ['Projects']
        ]);
        $pageName = $this->pageName;
        $this->set(compact('projectStage', 'pageName'));
        $this->set('_serialize', ['projectStage']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $projectStage = $this->ProjectStages->newEntity();
        if ($this->request->is('post')) {
            $projectStage = $this->ProjectStages->patchEntity($projectStage, $this->request->data);
            if ($this->ProjectStages->save($projectStage)) {
                $this->Flash->success(__('has been saved.', ['L\'', __('stage'), 'e']));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('could not be saved. Please, try again.', ['L\'', __('stage'), 'e']));
            }
        }
        $pageName = $this->pageName;
        $this->set(compact('projectStage', 'pageName'));
        $this->set('_serialize', ['projectStage']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Project Stage id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $projectStage = $this->ProjectStages->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $projectStage = $this->ProjectStages->patchEntity($projectStage, $this->request->data);
            if ($this->ProjectStages->save($projectStage)) {
                $this->Flash->success(__('has been saved.', ['L\'', __('stage'), 'e']));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('could not be saved. Please, try again.', ['L\'', __('stage'), 'e']));
            }
        }
        $pageName = $this->pageName;
        $this->set(compact('projectStage', 'pageName'));
        $this->set('_serialize', ['projectStage']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Project Stage id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $projectStage = $this->ProjectStages->get($id);
        if ($this->ProjectStages->delete($projectStage)) {
            $this->Flash->success(__('has been deleted.', ['L\'', __('stage'), 'e']));
        } else {
            $this->Flash->error(__('could not be deleted. Please, try again.', ['L\'', __('stage'), 'e']));
        }

        return $this->redirect(['action' => 'index']);
    }
}
