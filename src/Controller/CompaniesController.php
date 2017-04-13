<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Companies Controller
 *
 * @property \App\Model\Table\CompaniesTable $Companies
 */
class CompaniesController extends AppController
{

    public function initialize() {
        parent::initialize();
        $this->pageName = 'Companies';
        
        $this->user_type = $this->Auth->user('type');
        if($this->user_type == 'user'){
            $this->user_id = $this->Auth->user('user_id');
        }elseif($this->user_type == 'member'){
            $this->user_id = $this->Auth->user('member_id');
        }
    }
    
    public function isAuthorized($user = null){
        if(parent::isAuthorized($user)){
            return true;
        }
        
        $company_id = (isset($this->request->params['pass'][0])) ? $this->request->params['pass'][0] : null;
        if((isset($company_id))&&($this->haveAccessRight($user, $company_id))){
            return true;
        }
            
        if((isset($user['type']))&&($user['type'] === 'user')){
            
            if(in_array($this->request->action, ['index'])) {
                return true;
            }
            
            if($this->request->action == 'view'){
                //Si l'utilisateur appartient à cette societe 
                $company_id = $this->request->params['pass'][0];
                $users_company = $this->Companies->getusers_company($company_id);
                if(in_array($user['user_id'], $users_company)){
                    return true;
                }
                //Si l'utilisateur à 
            }
            //Autorisation pour les membres
        }elseif((isset($user['type']))&&($user['type'] === 'member')){ 
            if(in_array($this->request->action, ['index'])) {
                return true;
            }
        }
        return false;
    }
    
    public function haveAccessRight($user, $company_id) {
        if(in_array($this->request->action, ['delete'])) {//Pas d'access à la suppression
            return false;
        }
        if($this->Auth->user('group_manager')){//Access aux group managers
            return true;//High Access Level
        }
        if($user['type'] === 'client'){//Pas d'access aux clients
            return false;
        }
        
        $sessionUserId = ($user['type'] === 'user') ? $user['user_id'] : $user['member_id'];
        $isCompanyManager = $this->Companies->isCompanyManager($user['user_id'], $company_id, $user['type']);
        $accessLevel = $this->Companies->getUserAccessByCompany($sessionUserId, $user['type'], $company_id);
        if(($accessLevel === 2)||($accessLevel === 0)){
            return false;
        }
        if((isset($isCompanyManager))&&($isCompanyManager === 1)){
            return true;
        }
        if(($this->request->action === 'view')&&($accessLevel > 0)){
            return true;
        }
        if(($this->request->action === 'edit')&&($accessLevel > 3)){
            return true;
        }
        return false;
    }
    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index(){
        //$companies = $this->paginate($this->Companies);
        $companies = $this->paginate($this->Companies->companiesOfThisUser($this->user_type, $this->user_id, $this->Auth->user('group_manager')));
        //debug($companies);die();
        $pageName = $this->pageName;
        $this->set(compact('companies', 'pageName'));
        $this->set('_serialize', ['companies']);
    }

    /**
     * View method
     *
     * @param string|null $id Company id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $company = $this->Companies->get($id, [
            'contain' => ['Members', 'Users', 'Departements']
        ]);
        $pageName = $this->pageName;
        $this->set(compact('company', 'pageName'));
        $this->set('_serialize', ['company']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $company = $this->Companies->newEntity();
        if ($this->request->is('post')) {
            $company = $this->Companies->patchEntity($company, $this->request->data);
            if ($this->Companies->save($company)) {
                $this->Flash->success(__('The company has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The company could not be saved. Please, try again.'));
            }
        }
        $pageName = $this->pageName;
        $this->set(compact('company', 'pageName'));
        $this->set('_serialize', ['company']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Company id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $company = $this->Companies->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $company = $this->Companies->patchEntity($company, $this->request->data);
            if ($this->Companies->save($company)) {
                $this->Flash->success(__('The company has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The company could not be saved. Please, try again.'));
            }
        }
        $pageName = $this->pageName;
        $this->set(compact('company', 'pageName'));
        $this->set('_serialize', ['company']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Company id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $company = $this->Companies->get($id);
        if ($this->Companies->delete($company)) {
            $this->Flash->success(__('The company has been deleted.'));
        } else {
            $this->Flash->error(__('The company could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
