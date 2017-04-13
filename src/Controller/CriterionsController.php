<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Criterions Controller
 *
 * @property \App\Model\Table\CriterionsTable $Criterions
 */
class CriterionsController extends AppController
{

    public function initialize(){
        parent::initialize();
        $this->pageName = 'Criterions';
        $this->types_criterions = ['Projects' => __('Projects'), 'Employees' => __('Employees'), 'Teams' => __('Teams'), 'Departements' => __('Departements')];
        $this->loadComponent('RequestHandler');
        $this->loadComponent('Search.Prg', ['actions' => ['index', 'lookup']]);
    }
    
    public function isAuthorized($user = null){
        if(parent::isAuthorized($user)){
            return true;
        }
        
        if((isset($user['type']))&&(in_array($user['type'], ['user', 'member']))){
            if((isset($user['criterions_manager']))&&($user['criterions_manager'])){
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
        $criterions = $this->paginate($this->Criterions);
        $pageName = $this->pageName;
        $this->set(compact('criterions', 'pageName'));
        $this->set('_serialize', ['criterions']);
    }

    /**
     * View method
     *
     * @param string|null $id Criterion id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $criterion = $this->Criterions->get($id, [
            'contain' => ['Projects']
        ]);
        $pageName = $this->pageName;
        $this->set(compact('pageName'));
        $this->set('criterion', $criterion);
        $this->set('_serialize', ['criterion']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $criterion = $this->Criterions->newEntity();
        if ($this->request->is('post')) {
            $criterion = $this->Criterions->patchEntity($criterion, $this->request->data);
            if ($this->Criterions->save($criterion)) {
                $this->Flash->success(__('has been saved.', ['L\'', __('criterion'), '']));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('could not be saved. Please, try again.', ['L\'', __('criterion'), '']));
            }
        }
        
        $pageName = $this->pageName;
        $this->set(compact('pageName'));
        $types_criterions = $this->types_criterions;
        $this->set(compact('criterion', 'types_criterions', 'pageName'));
        $this->set('_serialize', ['criterion']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Criterion id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $criterion = $this->Criterions->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $criterion = $this->Criterions->patchEntity($criterion, $this->request->data);
            if ($this->Criterions->save($criterion)) {
                $this->Flash->success(__('has been saved.', ['L\'', __('criterion'), '']));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('could not be saved. Please, try again.', ['L\'', __('criterion'), '']));
            }
        }
        
        $pageName = $this->pageName;
        $this->set(compact('pageName'));
        $types_criterions = $this->types_criterions;
        $this->set(compact('criterion', 'types_criterions', 'pageName'));
        $this->set('_serialize', ['criterion']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Criterion id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $criterion = $this->Criterions->get($id);
        if ($this->Criterions->delete($criterion)) {
            $this->Flash->success(__('has been deleted.', ['L\'', __('criterion'), '']));
        } else {
            $this->Flash->error(__('could not be deleted. Please, try again.', ['L\'', __('criterion'), '']));
        }

        return $this->redirect(['action' => 'index']);
    }
}
