<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Datasource\ConnectionManager;
//use Cake\Event\Event;

use Search\Manager;
/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 */
class UsersController extends AppController
{

    
    public function initialize(){
        parent::initialize();
        $this->pageName = 'Users';
        $this->dir = USERS_UPLOAD_IMAGES;
        $this->loadComponent('Search.Prg', [
            // This is default config. You can modify "actions" as needed to make
            // the PRG component work only for specified methods.
            'actions' => ['index', 'lookup']
        ]);
        /*
        if($this->Auth->user()){
            $this->user = $this->Auth->session->read();
        }*/
        
    }
    
    public function isAuthorized($user = null){
        //S'il est un group manager ou un superadmin
        if(parent::isAuthorized($user)){
            return true;
        }
        
        $user_id = (isset($this->request->params['pass'][0])) ? $this->request->params['pass'][0] : null;
        $haveAccessRight = $this->haveAccessRight($user, $user_id);
        if($haveAccessRight === 'DENIED'){
            return false;
        }
        if($haveAccessRight){
            return true;
        }
        
        //$this->Users->getUsersOfTeam(18);
        if((isset($user['type']))&&($user['type'] === 'user')){
            //Get the user session
            $sessionUserId = ($user['type'] === 'user') ? $user['user_id'] : $user['member_id'];
            
            
            
            if((in_array($this->request->action, ['view', 'edit']))&&(isset($this->request->params['pass'][0]))){
                $user_id = $this->request->params['pass'][0];
                if($this->request->action === 'view'){    
                    if($user['user_id'] == $user_id){
                        return true;
                    }
                }
                $user_id = $this->request->params['pass'][0];
                $user_teams = $this->Users->getUserTeams($user_id)->toArray();
                if(!empty($user_teams['teams'])){//S'il n'y a aucune équipe
                    $teams_ids = $this->return_array($user_teams['teams'], 'id');
                    //On peut pas supprimer une relation entre le user et les anciennes équipes si on a pas le droit sur tous
                    foreach ($teams_ids as $key => $team_id) {
                        $dep_id = (isset($team_id)) ? $this->Users->Teams->getThisTeamDepId($team_id) : null;
                        $company_id = (isset($team_id)) ? $this->Users->Teams->getThisTeamCompanyId($team_id) : null;
                        if((!($this->Users->Teams->isTeamManager($sessionUserId, $team_id, $user['type'])))&&
                                ((!($this->Users->Teams->Departements->isDepartementManager($sessionUserId, $dep_id, $user['type']))))&&
                                ((!($this->Users->Teams->Departements->Companies->isCompanyManager($sessionUserId, $company_id, $user['type']))))){
                            return false;
                        }
                    }
                    //On peut pas modifier ou ajouter une relation entre le user et les nouveaux équipes associées par le form si on a pas le droit sur tous
                    if(($this->request->is(['patch', 'post', 'put']))){
                        if(!empty($this->request->data['teams']['_ids'])){
                            foreach ($this->request->data['teams']['_ids'] as $key => $team_id) {
                                $dep_id = (isset($team_id)) ? $this->Users->Teams->getThisTeamDepId($team_id) : null;
                                $company_id = (isset($team_id)) ? $this->Users->Teams->getThisTeamCompanyId($team_id) : null;
                                if((!($this->Users->Teams->isTeamManager($sessionUserId, $team_id, $user['type'])))&&
                                        ((!($this->Users->Teams->Departements->isDepartementManager($sessionUserId, $dep_id, $user['type']))))&&
                                        ((!($this->Users->Teams->Departements->Companies->isCompanyManager($sessionUserId, $company_id, $user['type']))))){
                                    return false;
                                }
                            }
                        }
                    }
                    return true;
                }
            }
            
            if($this->request->action === 'editAccessRights'){
                $user_id = $this->request->params['pass'][0];
                if($user['user_id'] == $user_id){
                    if ($this->request->is(['patch', 'post', 'put'])) {//Si l'utilisateur essaye de modifier ses accès ça va retourner false
                        return false;
                    }
                    return true; // Sinon il peut consulter ses droits
                }
            }
            //Autorisation pour les membres
        }elseif((isset($user['type']))&&($user['type'] === 'member')){ 
            /*if(in_array($this->request->action, ['index'])) {
                return true;
            }*/
        }
        return false;
    }
    
    public function haveAccessRight($user, $project_id, $action = null) {        
        
        if(in_array($this->request->action, ['delete'])) {//Pas d'access à la suppression
            return false;
        }
        
        if($user['type'] === 'client'){//Pas d'access aux clients
            return false;
        }
        
        if($this->request->action === 'index') {
            return true;
        }
        
        $sessionUserId = ($user['type'] === 'user') ? $user['user_id'] : $user['member_id'];
        
        
        return false;
    }
    
    public function allowByAccessLevelAndAction($accessLevel, $action) {
        if((($this->request->action === 'view')||(in_array($action, ['viewProjectInfo', 'viewProject', 'projecUrls/view'])))&&($accessLevel > 0)){
            return true;
        }
        if((($this->request->action === 'edit')||(in_array($action, ['projecUrls/add', 'projecUrls/edit'])))&&($accessLevel > 3)){
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
            'contain' => ['Authentifications'],
            'maxLimit' => 15,
            'order' => [
                'Users.name' => 'asc'
            ],
            'sortWhitelist' => ['Users.name', 'Users.lastName', 'Authentifications.email']
        ];
        $pageName = $this->pageName;
        $query = $this->Users
        ->find('search', ['search' => $this->request->query]);
        $this->set(compact('pageName'));
        $this->set('users', $this->paginate($query));
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null){
        $user = $this->Users->get($id, [
            'contain' => ['Teams' => ['queryBuilder' => function ($q) {
                                                            return $q->where(['AssocTeamsUsers.accessLevel >' => '1']);
                                                        }], 'Actiondisciplinaires', 'Projects' => ['queryBuilder' => function ($q) {
                                                            return $q->where(['AssocUsersProjects.accessLevel >' => '1']);
                                                        }], 'Rapports', 'Criterions', 'UserUrls', 'Authentifications']
        ]);
        //debug($user->toArray());die();
        $pageName = $this->pageName;
        $this->set(compact('pageName'));
        $this->set('user', $user);
        $this->set('_serialize', ['user']);
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
    
    private function criterions_update($criterions, $user_id){
        foreach ($criterions as $key => $criterion) {
            $assoc_id = $this->Users->AssocUsersCriterions->getAssocIdByCriterionAndUser($key, $user_id);
            $this->Users->AssocUsersCriterions->update_content($assoc_id, $criterion);
        }
    }
    
    private function criterions_update_percent($criterions_percent, $user_id){
        foreach ($criterions_percent as $key => $percent) {
            $assoc_id = $this->Users->AssocUsersCriterions->getAssocIdByCriterionAndUser($key, $user_id);
            $this->Users->AssocUsersCriterions->update_percent($assoc_id, $percent);
        }
    }
    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add(){
        //$type = $this->type_user;
        
        $user = $this->Users->newEntity();
        if ($this->request->is('post')){
            //S'il y a des critères :
            if((!empty($this->request->data['criterions']))||(!empty($this->request->data['criterions_percent']))){
                $criterions_data = $this->criterions_handle($this->request->data['criterions'], $this->request->data['criterions_percent']);
                unset($this->request->data['criterions']);
                if($criterions_data['criterions_ids'] !== null) {
                    $this->request->data['criterions']['_ids'] = $criterions_data['criterions_ids'];
                } 
            }
            
            $password = (!empty($this->request->data['password'])) ? $this->request->data['password'] : null;
            $email = (!empty($this->request->data['email'])) ? $this->request->data['email'] : null;
            $user = $this->Users->patchEntity($user, $this->request->data);
            $conn = ConnectionManager::get('default');
            $conn->begin();
            if(((!$this->Users->Authentifications->checkIfEmailValid($email))||($email === null))&&($result = $this->Users->save($user))){
                try {
                    $user_id = $result->id;
                    //enregistrer le mot de passe et l'email
                    if(!empty($email)){
                        $auth_id = $this->Users->Authentifications->addProfile($user_id, $email, $password, 'user');
                    }
                    
                    //S'il y a des critères :
                    if(!empty($this->request->data['criterions'])){
                        $this->criterions_update($criterions_data['criterions'], $user_id);
                    }
                    if((isset($criterions_data['criterions_percent']))&&(!empty($criterions_data['criterions_percent']))){
                        $this->criterions_update_percent($criterions_data['criterions_percent'], $user_id);
                    }
                    
                    //set image path
                    $this->request->data['path_image'] = $user_id.'-'.$this->slug($this->request->data['name'].$this->request->data['lastName']);
                    $this->Users->update_path_image($user_id, $this->request->data['path_image']);
                    //upload image
                    if((!empty($this->request->data['image']['name'])) && ($this->request->data['image']['name'] !== '')){
                        $this->app_file_upload($user_id, $this->request->data['image'], $this->request->data['path_image']);
                    }
                    
                    $this->Flash->success(__('has been saved.', ['Le ', __('employee'), '']));
                    $conn->commit();
                    return $this->redirect(['action' => 'view', $user_id]);
                } catch (\Exception $e) {
                    $conn->rollback();
                    $this->Flash->error(__('could not be saved. Please, try again.', ['Le ', __('employee'), '']));
                }
                //return $this->redirect(['action' => 'index']);
            }else{
                if(!$this->Users->Authentifications->checkIfEmailValid($email)){
                $this->Flash->error(__('Retry with another email.'));
                }else{
                    $this->Flash->error(__('could not be saved. Please, try again.', ['Le ', __('employee'), '']));
                }
                
            }
        }
        
        $projects = $this->Users->Projects->find('list');
        $pageName = $this->pageName;
        $teams = $this->Users->Teams->getTeamsHaveDepList();
        $criterions = $this->Users->Criterions->getCriterionsOfEmployee();
        //debug($criterions->toArray()); die();
        $this->set(compact('user', 'pageName', 'projects', 'type', 'criterions', 'teams'));
        $this->set('_serialize', ['user']);
    }

    /**
     * 
     * @param type $id
     * @param type $data
     */
    /*private function file_upload($id, $data){
        if(($data['path_image']['name'] !== '') && (!empty($data['path_image']['name']))){
            //upload image
            $folderName = $id.'-'.$data['name'].$data['lastName'];
            $pathToDir = $this->dir_images.DS.$folderName;
            if (!file_exists($pathToDir)) {
                mkdir($pathToDir, 0777, true);
            }
            //Remplacer les espaces par '_'
            $fileToUpload = $data['path_image'];
            $fileToUpload['name'] = str_replace(' ', '_', $fileToUpload['name']);
            //Récuperation du racine et ajout d'un prefixe id pour chaque doc
            $path = $pathToDir . DS . $id . '_' .$fileToUpload['name'];
            //$user['path_image'] = $path;
            //Upload
            if(move_uploaded_file($fileToUpload['tmp_name'], $path)){
                $userUpdate = $this->Users->get($id);
                $userUpdate->path_image = $path;
                $this->Users->save($userUpdate);
            }else{
                $this->Flash->error(__('Image upload : problem.'));
            }
        }
    }*/
    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null){
        $user = $this->Users->get($id, [
            'contain' => ['Criterions', 'Teams' => ['queryBuilder' => function ($q) {
                                                            return $q->where(['AssocTeamsUsers.accessLevel >' => '1']);
                                                        }], 'Authentifications']
        ]);
        //debug($user);die();
        if ($this->request->is(['patch', 'post', 'put'])) {
            //debug($this->request->data);die();
            //S'il y a des critères :
            /*if((!empty($this->request->data['criterions']))||(!empty($this->request->data['criterions_percent']))){
                $criterions_data = $this->criterions_handle($this->request->data['criterions'], $this->request->data['criterions_percent']);
                unset($this->request->data['criterions']);
                if($criterions_data['criterions_ids'] !== null) {
                    $this->request->data['criterions']['_ids'] = $criterions_data['criterions_ids'];
                } 
            }*/
            if(!empty($this->request->data['criterions'])){
                foreach ($this->request->data['criterions'] as $key => $criterion) {
                    if((trim($criterion['_joinData']['content'] === ''))&&(($criterion['_joinData']['percent'] === ''))){
                        unset($this->request->data['criterions'][$key]);
                    }
                }
            }
            //unset($this->request->data['criterions']);
            if($user->authentification->email == $this->request->data['authentification']['email']){
                unset($this->request->data['authentification']['email']);
            }
            $user = $this->Users->patchEntity($user, $this->request->data, ['associated' => ['Authentifications', 'Criterions', 'Teams']]);
            //debug($user);die();
            //$password = (!empty($this->request->data['password'])) ? $this->request->data['password'] : null;
            //$email = (!empty($this->request->data['email'])) ? $this->request->data['email'] : null;
            /*
            if($user->authentification->password == $this->request->data['authentification']['password']){
                unset($this->request->data['authentification']['password']);
            }
            */
            //debug($user); die();
            
            //debug($email === null);die();
            //debug($user); die();
            $conn = ConnectionManager::get('default');
            $conn->begin();
            //if (((!$this->Users->Authentifications->checkIfEmailValid($email, $id, 'user'))||($email === null))&&($this->Users->save($user, ['associated' => ['Authentifications']]))) {
            if ($this->Users->save($user, ['associated' => ['Authentifications', 'Criterions', 'Teams']])) {
                try {
                    /*$auth_id = $this->Users->Authentifications->getAuthIdByRelatedIdAndType($id, 'user');
                    if(isset($auth_id)){
                        if(!empty($password)){
                            $ok = $this->Users->Authentifications->updatePassword($auth_id, $password);
                        }*//*
                        if(!empty($email)){
                            $ok = $this->Users->Authentifications->updateEmail($auth_id, $email);
                        }*/
                        //Update the access rights
                        //$ok = $this->Users->Authentifications->updateAccessRights($auth_id, $this->request->data['criterions_rights'], $this->request->data['priorities_rights'], $this->request->data['stages_rights'], $this->request->data['clients_rights']);
                    /*}*//*else{ //si y a pas un auth_id
                        $this->Users->Authentifications->addProfile($id, $email, $password, 'user');
                    }*/
                    //S'il y a des critères :
                    /*
                    if(!empty($this->request->data['criterions'])){
                        $this->criterions_update($criterions_data['criterions'], $user_id);
                    }
                    if((isset($criterions_data['criterions_percent']))&&(!empty($criterions_data['criterions_percent']))){
                        $this->criterions_update_percent($criterions_data['criterions_percent'], $user_id);
                    }
                    */
                    //Check if there is a file to upload
                    if((!empty($this->request->data['image']['name'])) && ($this->request->data['image']['name'] !== '')){
                        //check if the folder is empty or not exist
                        $dir = $this->dir.DS.$user->path_image;
                        /*Pour les anciens users == Debut*/
                        if($user->path_image == null){
                            $this->request->data['path_image'] = $id.'-'.$this->slug($user->name.$user->lastName);
                            $this->Users->update_path_image($id, $this->request->data['path_image']);
                            $path_dir = $this->request->data['path_image'];
                        }else{
                            $path_dir = $user->path_dir;
                        }
                        /*Pour les anciens users == Fin*/
                        /*La premiere condition pour les anciens users == $user->path_image == null*/
                        if(($user->path_image == null)||((!file_exists($dir)) || (count(scandir($dir)) == 2))){
                            $this->app_file_upload($id, $this->request->data['image'], $path_dir);
                        }else{
                            $this->Flash->error(__('Doc upload : problem.1'));
                        }
                    }
                    
                    $this->Flash->success(__('has been saved.', ['Le ', __('employee'), '']));
                    $conn->commit();
                    return $this->redirect(['action' => 'view', $id]);
                } catch (\Exception $e) {
                    $conn->rollback();
                    //die('aaa');
                    $this->Flash->error(__('could not be saved. Please, try again.', ['Le ', __('employee'), '']));
                }
                
            } else {
                $this->Flash->error(__('could not be saved. Please, try again.', ['Le ', __('employee'), '']));
            }
        }
        $files = $this->getFilesByDir($this->dir, $user->path_image);
        
        $teams = $this->Users->Teams->getTeamsHaveDepList();
        $criterions = $this->Users->Criterions->getCriterionsOfEmployee();
        $content_byIds = $this->Users->AssocUsersCriterions->getContentByIdUser($id);
        $percent_byIds = $this->Users->AssocUsersCriterions->getPercentByIdUser($id);
        
        /*$criterions = $this->Users->Criterions->getCriterionsOfEmployee();
        $content_byIds = $this->Users->AssocUsersCriterions->getContentByIdUsers($id);*/
        $pageName = $this->pageName;
        //$type = $this->type_user;
        $this->set(compact('user', 'pageName', 'files', 'percent_byIds', 'type', 'teams', 'criterions', 'content_byIds'));
        $this->set('_serialize', ['user']);
    }

    public function editAccessRights($id) {
        $user = $this->Users->get($id, [
            'contain' => ['Authentifications']
        ]);
        //debug($user);die();
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->data, ['associated' => ['Authentifications']]);
            
            $conn = ConnectionManager::get('default');
            $conn->begin();
            if ($this->Users->save($user, ['associated' => ['Authentifications']])) {
                try {
                    $this->Flash->success(__('has been saved.', ['Le ', __('employee'), '']));
                    $conn->commit();
                    return $this->redirect(['action' => 'view', $id]);
                } catch (\Exception $e) {
                    $conn->rollback();
                    $this->Flash->error(__('could not be saved. Please, try again.', ['Le ', __('employee'), '']));
                }
            } else {
                $this->Flash->error(__('could not be saved. Please, try again.', ['Le ', __('employee'), '']));
            }
        }
        $pageName = $this->pageName;
        //$type = $this->type_user;
        $this->set(compact('user', 'pageName'));
    }
    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null){
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('has been deleted.', ['Le ', __('employee'), '']));
        } else {
            $this->Flash->error(__('could not be deleted. Please, try again.', ['Le ', __('employee'), '']));
        }

        return $this->redirect(['action' => 'index']);
    }
    
    //Delete file
    public function deletefile($path_dir, $namefile) {
        $msg = '';
        if (isset($path_dir)&&(isset($namefile))) {
            $path_file = $this->dir.DS.$path_dir.DS.$namefile;
            if(file_exists($path_file)){
                if(unlink($path_file)){
                    $msg = 'deleted';
                }else{
                    $msg = 'notdeleted';
                }
            }else{
                $msg = 'notfound';
            }
        }
        $this->set(compact('msg', 'namefile'));
    }
    
    /*public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->Auth->allow(['index', 'view', 'add', 'edit', 'logout']);
    }*/
    
    /*public function login()
    {
        if ($this->request->is('post')) {
            $user = $this->Auth->identify();
            //debug($user);die();
            if ($user) {
                $this->Auth->setUser($user);
                $this->Auth->redirectUrl();
                return $this->redirect($this->Auth->redirectUrl());
            }
            $this->Flash->error(__('Invalid email or password, try again'));
        }
    }*/
    /**
     * 
     * @return type
     */
    /*public function logout()
    {
        return $this->redirect($this->Auth->logout());
        //return $this->redirect(['controller' => 'Authentifications', 'action' => 'login']);
    }*/
}
