<?php
namespace App\Controller;

use App\Controller\AppController;
use Search\Manager;

use Cake\ORM\Table;
use Cake\ORM\TableRegistry;
use Cake\Event\Event;
use Cake\Datasource\ConnectionManager;
use Cake\Network\Exception\NotFoundException;
/**
 * Departements Controller
 *
 * @property \App\Model\Table\DepartementsTable $Departements
 */
class DepartementsController extends AppController{

    public function initialize(){
        parent::initialize();
        
        $this->user_type = $this->Auth->user('type');
        if($this->user_type == 'user'){
            $this->user_id = $this->Auth->user('user_id');
        }elseif($this->user_type == 'member'){
            $this->user_id = $this->Auth->user('member_id');
        }
        
        $this->pageName = 'Départements';
        $this->loadComponent('Search.Prg', ['actions' => ['index', 'lookup']]);
    }
    
    public function isAuthorized($user = null){
        if(parent::isAuthorized($user)){
            return true;
        }
        $departement_id = (isset($this->request->params['pass'][0])) ? $this->request->params['pass'][0] : null;
        $haveAccessRight = $this->haveAccessRight($user, $departement_id);
        if($haveAccessRight === 'DENIED'){
            return false;
        }
        if($haveAccessRight){
            return true;
        }
        
        if((isset($user['type']))&&(($user['type'] === 'user')||($user['type'] === 'member'))){
            /*if(in_array($this->request->action, ['index'])) {
                return true;
            }
            */
            $sessionUserId = ($user['type'] === 'user') ? $user['user_id'] : $user['member_id'];
            
            if($this->request->action == 'view'){
                $dep_id = $this->request->params['pass'][0];
                $users_departement = $this->Departements->getusers_departement($dep_id);
                if(in_array($sessionUserId, $users_departement)){
                    return true;
                }
            }
            
            if($this->request->action == 'add'){
                if($this->request->is(['patch', 'post', 'put'])) {
                    //debug($this->request->data['company_id']);die();
                    $company_id = (isset($this->request->data['company_id'])) ? $this->request->data['company_id'] : null;
                    $isCompanyManager = (isset($company_id)) ? $this->Departements->Companies->isCompanyManager($sessionUserId, $company_id, $user['type']) : null;
                    if($isCompanyManager){
                        return true;
                    }
                }
            }
        }
        return false;
    }
    /**
     * 
     * @param type $user
     * @param type $project_id
     * @param type $action ////// QUAND CETTE FONCTION EST APPELEE DEPUIS LE CONTROLLER CONSULT ET AVEC UNE ACTION DE LA 
     * @return boolean|string
     */
    public function haveAccessRight($user, $departement_id, $action = null) {
        if(in_array($this->request->action, ['delete'])) {//Pas d'access à la suppression
            return false;
        }
        if($this->Auth->user('group_manager')){//Access aux group managers
            return true;//High Access Level
        }
        if($user['type'] === 'client'){//Pas d'access aux clients
            return false;
        }
        
        if(in_array($this->request->action, ['index'])) {
            return true;
        }
        //sessionUserId User ou Member
        $sessionUserId = ($user['type'] === 'user') ? $user['user_id'] : $user['member_id'];
        //Si l'action est add = test s'il est un Manager d'une societe 
        if((in_array($this->request->action, ['add']))&&($this->Departements->Companies->heIsACompanyManager($sessionUserId, $user['type']))) {
            if(!($this->request->is(['patch', 'post', 'put']))){
                return true;
            }
            return false;//Pas nécessaire de terminer cette fonction
        }
        //Celui ci est un CompanyManager = Lui donner l'access
        
        $company_id = (isset($departement_id)) ? $this->Departements->getThisDepCompanyId($departement_id) : null;
        
        //debug(array($sessionUserId, $company_id, $user['type']));die();
        $isCompanyManager = (isset($company_id)) ? $this->Departements->Companies->isCompanyManager($sessionUserId, $company_id, $user['type']) : 0;
        //die('aa');
        if($isCompanyManager){
            return true;
        }
        
        $accessLevel = (isset($company_id)) ? $this->Departements->Companies->getUserAccessByCompany($sessionUserId, $user['type'], $company_id) : null;
        if(($accessLevel === 2)||($accessLevel === 0)){
            return 'DENIED';
        }
        if($this->allowByAccessLevelAndAction($accessLevel, $action)){
            return true;
        }
        
        //Departement Manager
        $isDepartementManager = (isset($departement_id)) ? $this->Departements->isDepartementManager($sessionUserId, $departement_id, $user['type']) : 0;
        
        if($isDepartementManager){
            return true;
        }
        
        $accessLevel = (isset($departement_id)) ? $this->Departements->getUserAccessByDepartement($sessionUserId, $user['type'], $departement_id) : null;
        if(($accessLevel === 2)||($accessLevel === 0)){
            return 'DENIED';
        }
        if($this->allowByAccessLevelAndAction($accessLevel, $action)){
            return true;
        }
        return false;
    }
    
    public function allowByAccessLevelAndAction($accessLevel, $action) {
        if((($this->request->action === 'view')||($action === 'viewDepartement'))&&($accessLevel > 0)){
            /*$dep_id = $this->request->params['pass'][0];
            $users_departement = $this->Departements->getusers_departement($dep_id);
            if(in_array($sessionUserId, $users_departement)){
                return true;
            }*/
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
        $this->paginate = [
            'maxLimit' => 15
        ];
        $query = $this->Departements->departementsOfThisUser($this->user_type, $this->user_id, $this->Auth->user('group_manager'))->find('search', ['search' => $this->request->query]);
        /*$query = $this->Departements
        ->find('search', ['search' => $this->request->query]);*/
        $departements = $this->paginate($query);
        
        $pageName = $this->pageName;
        $this->set(compact('departements', 'pageName'));
        $this->set('_serialize', ['departements']);
        $this->set('isSearch', $this->Departements->isSearch());
    }

    /**
     * View method
     *
     * @param string|null $id Departement id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null){
        $departement = $this->Departements->get($id, [
            'contain' => ['Teams', 'Criterions']
        ]);

        $pageName = $this->pageName;
        $this->set(compact('pageName'));
        $this->set('departement', $departement);
        $this->set('_serialize', ['departement']);
    }

    private function criterions_handle($criterions, $criterions_percent) {
        $criterions_ids = array();
        foreach ($criterions as $key => $criterion) {
            $criterions[$key] = trim($criterion, ' ');
            if((isset($criterions[$key])) && ($criterions[$key] !=="")){
                $criterions_ids[] = $key;
            }
        }
        foreach ($criterions_percent as $key => $percent) {
            if((!empty($percent))&&($percent >= 0)&&($percent <= 100)){
                $criterions_percent_checked[$key] = $percent;
                if(!in_array($key, $criterions_ids)){
                    $criterions_ids[] = $key;
                }
            }
        }
        if(!empty($criterions_ids)){
            $data['criterions_ids'] = $criterions_ids;
            $data['criterions'] = $criterions;
            $data['criterions_percent'] = $criterions_percent_checked;
        }else{
            $data['criterions_ids'] = null;
        }
        
        return $data;
    }
    
    private function criterions_update($criterions, $departement_id){
        foreach ($criterions as $key => $criterion) {
            $assoc_id = $this->Departements->AssocDepartementsCriterions->getAssocIdByCriterionAndDepartement($key, $departement_id);
            $this->Departements->AssocDepartementsCriterions->update_content($assoc_id, $criterion);
        }
    }
    
    private function criterions_update_percent($criterions_percent, $departement_id){
        foreach ($criterions_percent as $key => $percent) {
            $assoc_id = $this->Departements->AssocDepartementsCriterions->getAssocIdByCriterionAndDepartement($key, $departement_id);
            $this->Departements->AssocDepartementsCriterions->update_percent($assoc_id, $percent);
        }
    }
    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add(){
        $departement = $this->Departements->newEntity();
        if ($this->request->is('post')) {
            
            //S'il y a des critères :
            if((!empty($this->request->data['criterions']))||(!empty($this->request->data['criterions_percent']))){
                $criterions_data = $this->criterions_handle($this->request->data['criterions'], $this->request->data['criterions_percent']);
                unset($this->request->data['criterions']);
                if($criterions_data['criterions_ids'] !== null) {
                    $this->request->data['criterions']['_ids'] = $criterions_data['criterions_ids'];
                } 
            }
            
            $departement = $this->Departements->patchEntity($departement, $this->request->data);
            $conn = ConnectionManager::get('default');
            $conn->begin();
            if ($result = $this->Departements->save($departement)) {
                
                try {
                    $departement_id = $result->id;
                    //S'il y a des critères :
                    if(!empty($this->request->data['criterions'])){
                        $this->criterions_update($criterions_data['criterions'], $departement_id);
                    }
                    if((isset($criterions_data['criterions_percent']))&&(!empty($criterions_data['criterions_percent']))){
                        $this->criterions_update_percent($criterions_data['criterions_percent'], $departement_id);
                    }
                    
                    $this->Flash->success(__('has been saved.', ['Le ', __('departement'), '']));
                    $conn->commit();
                } catch (\Exception $e) {
                    $conn->rollback();
                    $this->Flash->error(__('could not be saved. Please, try again.', ['Le ', __('departement'), '']));
                }
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('could not be saved. Please, try again.', ['Le ', __('departement'), '']));
            }
        }
        $pageName = $this->pageName;
        $criterions = $this->Departements->Criterions->getCriterionsOfDepartements();
        $companies = $this->Departements->Companies->getCompanies();
        $this->set(compact('departement', 'pageName', 'criterions', 'companies'));
        $this->set('_serialize', ['departement']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Departement id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null){
        $departement = $this->Departements->get($id, [
            'contain' => ['Criterions']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            //S'il y a des critères :
            if((!empty($this->request->data['criterions']))||(!empty($this->request->data['criterions_percent']))){
                $criterions_data = $this->criterions_handle($this->request->data['criterions'], $this->request->data['criterions_percent']);
                unset($this->request->data['criterions']);
                if($criterions_data['criterions_ids'] !== null) {
                    $this->request->data['criterions']['_ids'] = $criterions_data['criterions_ids'];
                } 
            }
            
            $departement = $this->Departements->patchEntity($departement, $this->request->data);
            $conn = ConnectionManager::get('default');
            $conn->begin();
            if ($this->Departements->save($departement)) {
                try {
                    $departement_id = $id;
                    //S'il y a des critères :
                    if(!empty($this->request->data['criterions'])){
                        $this->criterions_update($criterions_data['criterions'], $departement_id);
                    }
                    if((isset($criterions_data['criterions_percent']))&&(!empty($criterions_data['criterions_percent']))){
                        $this->criterions_update_percent($criterions_data['criterions_percent'], $departement_id);
                    }
                    $this->Flash->success(__('has been saved.', ['Le ', __('departement'), '']));
                    $conn->commit();
                } catch (\Exception $e) {
                    $conn->rollback();
                    $this->Flash->error(__('could not be saved. Please, try again.', ['Le ', __('departement'), '']));
                }
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('could not be saved. Please, try again.', ['Le ', __('departement'), '']));
            }
        }
        $pageName = $this->pageName;
        $criterions = $this->Departements->Criterions->getCriterionsOfDepartements();
        $companies = $this->Departements->Companies->getCompanies();
        $content_byIds = $this->Departements->AssocDepartementsCriterions->getContentByIdDepartement($id);
        $percent_byIds = $this->Departements->AssocDepartementsCriterions->getPercentByIdDepartement($id);
        $this->set(compact('departement', 'pageName', 'criterions', 'content_byIds', 'percent_byIds', 'companies'));
        $this->set('_serialize', ['departement']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Departement id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null){
        $this->request->allowMethod(['post', 'delete']);
        $departement = $this->Departements->get($id);
        if ($this->Departements->delete($departement)) {
            $this->Flash->success(__('has been deleted.', ['Le ', __('departement'), '']));
        } else {
            $this->Flash->error(__('could not be deleted. Please, try again.', ['Le ', __('departement'), '']));
        }

        return $this->redirect(['action' => 'index']);
    }
    /*
    public function getAllDepData(){
        $departements = $this->Departements->find('all')->contain(['Teams', 'Teams.Projects', 'Teams.Users','Teams.Projects.Users'])->order(['name' => 'ASC'])->toArray();
        
        return $departements;
    }
    
    public function test() {
        $this->loadModel('Departements');
        $result = $this->Departements->getAllDepData1();
        debug($result); die();
        return $this->Departements->getAllDepData1();
    }*/
}
