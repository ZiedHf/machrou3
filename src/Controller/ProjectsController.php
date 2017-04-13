<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Controller\Component\FlashComponent;

//use App\Controller\AppController;
use Cake\ORM\Table;
use Cake\ORM\TableRegistry;
use Cake\Event\Event;
use Cake\Datasource\ConnectionManager;

use Cake\Filesystem\Folder;
use Cake\Filesystem\File;
use Cake\Network\Response;
use Cake\Network\Exception\NotFoundException;

use Search\Manager;
/**
 * Projects Controller
 *
 * @property \App\Model\Table\ProjectsTable $Projects
 */
class ProjectsController extends AppController
{

    public function initialize(){
        parent::initialize();
        $this->pageName = 'Projets';
        $this->dir_projects = PROJECTS_UPLOAD;
        $this->loadComponent('RequestHandler');
        $this->loadComponent('Search.Prg', ['actions' => ['index', 'lookup']]);
        $this->loadModel('AssocUsersProjects');
    }
    
    public function isAuthorized($user = null){
        if(parent::isAuthorized($user)){
            return true;
        }
        
        $project_id = (isset($this->request->params['pass'][0])) ? $this->request->params['pass'][0] : null;
        $haveAccessRight = $this->haveAccessRight($user, $project_id);
        if($haveAccessRight === 'DENIED'){
            return false;
        }
        if($haveAccessRight){
            return true;
        }
        
        
        if((isset($user['type']))&&(($user['type'] === 'user')||($user['type'] === 'member'))){
            // Si le user est un chef d'équipe ou dep ou societe il aura l'accés à add function (Voir la fonction haveAccessRight)
            // Ici on teste s'il a l'autorization d'ajouter : 'post'
            $sessionUserId = ($user['type'] === 'user') ? $user['user_id'] : $user['member_id'];
            if($this->request->action === 'add'){
                
                if(!($this->request->is(['patch', 'post', 'put']))){
                    if((($this->Projects->Teams->heIsATeamManager($sessionUserId, $user['type']))||
                    ($this->Projects->Teams->Departements->heIsADepartementManager($sessionUserId, $user['type']))||
                    ($this->Projects->Teams->Departements->Companies->heIsACompanyManager($sessionUserId, $user['type'])))) {
                        return true;
                    }
                }elseif(($this->request->is(['patch', 'post', 'put']))&&(!empty($this->request->data['teams']['_ids']))){
                    $i = 0;
                    //Test sur tout les Teams
                    while(isset($this->request->data['teams']['_ids'][$i])){
                        $isTeamManager = false;
                        $isDepartementManager = false;
                        $isCompanyManager = false;
                        $team_id = $this->request->data['teams']['_ids'][$i];
                        if((isset($team_id))&&($this->Projects->Teams->isTeamManager($sessionUserId, $team_id, $user['type']))){
                            $isTeamManager = true;
                        }
                        $dep_id = (isset($team_id)) ? $this->Projects->Teams->getThisTeamDepId($team_id) : null;
                        $isDepartementManager = (isset($dep_id)) ? $this->Projects->Teams->Departements->isDepartementManager($sessionUserId, $dep_id, $user['type']) : null;
                        if($isDepartementManager){
                            $isDepartementManager = true;
                        }
                        $company_id = (isset($team_id)) ? $this->Projects->Teams->getThisTeamCompanyId($team_id) : null;
                        $isCompanyManager = (isset($company_id)) ? $this->Projects->Teams->Departements->Companies->isCompanyManager($sessionUserId, $company_id, $user['type']) : null;
                        if($isCompanyManager){
                            $isCompanyManager = true;
                        }

                        if(!(($isTeamManager)||($isDepartementManager)||($isCompanyManager))){
                            return false; // Si ce utilisateur n'a pas l'access sur un team ni sur son dep ni son société
                        }
                        $i++;
                    }
                    return true; // Si il a passé tous les test on lui donne les access
                }
            }
                
            
            if(($this->request->action == 'edit')){
                $project_id = $this->request->params['pass'][0];
                $teams_id = $this->Projects->getThisProjectTeamsId($project_id);
                if(!($this->request->is(['patch', 'post', 'put']))){
                    if($sessionUserId == $this->Projects->getProjectManagerByIdProject($project_id)){
                        return true;
                    }
                    foreach ($teams_id as $key => $team_id) {
                        //S'il est le manager
                        if($this->Projects->Teams->isTeamManager($sessionUserId, $team_id, $user['type'])){
                            return true;
                        }
                        $dep_id = (isset($team_id)) ? $this->Projects->Teams->getThisTeamDepId($team_id) : null;
                        $isDepartementManager = (isset($dep_id)) ? $this->Projects->Teams->Departements->isDepartementManager($sessionUserId, $dep_id, $user['type']) : null;
                        if($isDepartementManager){
                            return true;
                        }
                        $company_id = (isset($team_id)) ? $this->Projects->Teams->getThisTeamCompanyId($team_id) : null;
                        $isCompanyManager = (isset($company_id)) ? $this->Projects->Teams->Departements->Companies->isCompanyManager($sessionUserId, $company_id, $user['type']) : null;
                        if($isCompanyManager){
                            return true;
                        }
                    }
                }elseif(($this->request->is(['patch', 'post', 'put']))&&(!empty($this->request->data['teams']['_ids']))){
                    if($this->request->data['teams']['_ids'] == $teams_id){
                        return true;
                    }else{
                        if((!empty($this->request->data['teams']['_ids']))&&(!empty($teams_id))){
                            $allTeams = array_unique(array_merge($this->request->data['teams']['_ids'], $teams_id));
                            foreach ($allTeams as $key => $team_id) {
                                $isTeamManager = false;
                                $isDepartementManager = false;
                                $isCompanyManager = false;
                                if((isset($team_id))&&($this->Projects->Teams->isTeamManager($sessionUserId, $team_id, $user['type']))){
                                    $isTeamManager = true;
                                }
                                $dep_id = (isset($team_id)) ? $this->Projects->Teams->getThisTeamDepId($team_id) : null;
                                $isDepartementManager = (isset($dep_id)) ? $this->Projects->Teams->Departements->isDepartementManager($sessionUserId, $dep_id, $user['type']) : null;
                                if($isDepartementManager){
                                    $isDepartementManager = true;
                                }
                                $company_id = (isset($team_id)) ? $this->Projects->Teams->getThisTeamCompanyId($team_id) : null;
                                $isCompanyManager = (isset($company_id)) ? $this->Projects->Teams->Departements->Companies->isCompanyManager($sessionUserId, $company_id, $user['type']) : null;
                                if($isCompanyManager){
                                    $isCompanyManager = true;
                                }

                                if(!(($isTeamManager)||($isDepartementManager)||($isCompanyManager))){
                                    return false; // Si ce utilisateur n'a pas l'access sur un team ni sur son dep ni son société
                                }
                            }
                            return true;
                        }
                        
                    }
                }
            }
            /*
            if($this->request->action == 'edit') { // S'il est le chef de projet
                $project_id = $this->request->params['pass'][0];
                $idChefProject = $this->AssocUsersProjects->getProjectManagerByIdProject($project_id);
                if($idChefProject == $user['user_id']){
                    return true;
                }
            }
            
            if($this->request->action == 'view'){
                $project_id = $this->request->params['pass'][0];
                $users_team = $this->Projects->getusers_project($project_id);
                if(in_array($user['user_id'], $users_team)){
                    return true;
                }
            }*/
            //Autorisation pour les membres
        }/*elseif((isset($user['type']))&&($user['type'] === 'member')){ 
            if(in_array($this->request->action, ['index'])) {
                return true;
            }
        }*/
        return false;
    }
    /**
     * 
     * @param type $user
     * @param type $project_id
     * @param type $action ////// QUAND CETTE FONCTION EST APPELEE DEPUIS LE CONTROLLER CONSULT ET AVEC UNE ACTION DE LA 
     * @return boolean|string
     */
    public function haveAccessRight($user, $project_id, $action = null) {
        if(in_array($this->request->action, ['delete'])) {//Pas d'access à la suppression
            return false;
        }
        if($this->Auth->user('group_manager')){//Access aux group managers
            return true;//High Access Level
        }
        if($user['type'] === 'client'){//Pas d'access aux clients
            return false;
        }
        
        if($this->request->action === 'index') {
            return true;
        }
        
        $sessionUserId = ($user['type'] === 'user') ? $user['user_id'] : $user['member_id'];
        //Si l'action est add = test s'il est un Manager d'un departement ou une societé ou un team
        if((in_array($this->request->action, ['add', 'edit']))){
            return false;
        }
        //Celui ci est un CompanyManager = a l'access
        $companies_id = (isset($project_id)) ? $this->Projects->getThisProjectCompaniesId($project_id) : null;
        
        $i = 0;
        $haveCustomizeDenied = false;
        while (isset($companies_id[$i])) {
            $isCompanyManager = $this->Projects->Teams->Departements->Companies->isCompanyManager($sessionUserId, $companies_id[$i], $user['type']);
            if($isCompanyManager){
                return true;
            }
            
            $accessLevel = $this->Projects->Teams->Departements->Companies->getUserAccessByCompany($sessionUserId, $user['type'], $companies_id[$i]);
            
            if(($accessLevel === 2)||($accessLevel === 0)){
                $haveCustomizeDenied = true;
            }
            if($this->allowByAccessLevelAndAction($accessLevel, $action)){
                return true;
            }
            $i++;
        }
        //Se le manager a lui donnée l'accés à une société il peut voir le projet et la boucle au dessus va retourner TRUE
        //Sinon si le manager lui interdit l'access il ne peut pas voir le projet et la condition ci dessous retourne DENIED
        if($haveCustomizeDenied){
            return 'DENIED';
        }
        
        //Departement Manager
        $departements_id = (isset($project_id)) ? $this->Projects->getThisProjectDepartementsId($project_id) : null;
        $i = 0;
        //$haveCustomizeDenied = false;
        while (isset($departements_id[$i])) {
            $isDepartementManager = $this->Projects->Teams->Departements->isDepartementManager($sessionUserId, $departements_id[$i], $user['type']);
            if($isDepartementManager){
                return true;
            }
            
            $accessLevel = $this->Projects->Teams->Departements->getUserAccessByDepartement($sessionUserId, $user['type'], $departements_id[$i]);
            if(($accessLevel === 2)||($accessLevel === 0)){
                $haveCustomizeDenied = true;
            }
            if($this->allowByAccessLevelAndAction($accessLevel, $action)){
                return true;
            }
            $i++;
        }
        //Se le manager a lui donnée l'accés à un departement il peut voir le projet et la boucle au dessus va retourner TRUE
        //Sinon si le manager lui interdit l'access il ne peut pas voir le projet et la condition ci dessous retourne DENIED
        if($haveCustomizeDenied){
            return 'DENIED';
        }
        
        //Team Manager
        $teams_id = (isset($project_id)) ? $this->Projects->getThisProjectTeamsId($project_id) : null;
        $i = 0;
        //$haveCustomizeDenied = false;
        while (isset($teams_id[$i])) {
            $isTeamManager = $this->Projects->Teams->isTeamManager($sessionUserId, $teams_id[$i], $user['type']);
            if($isTeamManager){
                return true;
            }
            
            $accessLevel = $this->Projects->Teams->getUserAccessByTeam($sessionUserId, $user['type'], $teams_id[$i]);
            if(($accessLevel === 2)||($accessLevel === 0)){
                $haveCustomizeDenied = true;
            }
            
            //$allowedByTeam = ((isset($allowedByTeam))&&($allowedByTeam)) ? true : false;
            
            if($this->allowByAccessLevelAndAction($accessLevel, $action)){
                //return true;
                if($accessLevel > 3){//S'il est un editeur ou un manager il a l'accès directement
                    return true;
                }
                //$allowedByTeam = true; // sinon on doit conserver cette valeur pour tester sur ses droits d'accès de projet
            }
            $i++;
        }
        //debug($allowedByTeam);die();
        //Si le manager a lui donnée l'accés à un team il peut voir le projet et la boucle au dessus va retourner TRUE
        //Sinon si le manager lui interdit l'access il ne peut pas voir le projet et la condition ci dessous retourne DENIED
        if($haveCustomizeDenied){
            return 'DENIED';
        }
        
        //Project Manager
        
        $project_manager = isset($project_id) ? $this->Projects->getProjectManagerByIdProject($project_id) : null;
        //debug($sessionUserId);die();
        if($project_manager == $sessionUserId){
            return true;
        }
        
        //Get Access Level
        $accessLevel = (isset($project_id)) ? $this->Projects->getUserAccessByProject($user['user_id'], $user['type'], $project_id) : null;
        
        if(($accessLevel === 2)||($accessLevel === 0)){
            return 'DENIED';
        }
        //if(($this->allowByAccessLevelAndAction($accessLevel, $action))||((isset($allowedByTeam))&&($allowedByTeam))){//Si ce user n'est pas interdit de voir ce projet alors on lui donne les accès par défaut de projet et de team
        if($this->allowByAccessLevelAndAction($accessLevel, $action)){//Si ce user n'est pas interdit de voir ce projet alors on lui donne les accès par défaut de projet
            return true;
        }
        //die('aaa');
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
            'contain' => ['Clients', 'Users'],
            'maxLimit' => 15
        ];
        $query = $this->Projects
        ->find('search', ['search' => $this->request->query]);
        //->contain(['Clients', 'Users']);
        
        $projects = $this->paginate($query);
        $users = $this->Projects->Users->find('list');
        $clients = $this->Projects->Clients->find('list');
        $priorities = $this->Projects->Priorities->getPrioritiesListByOrder();
        $projectStages = $this->Projects->ProjectStages->getStagesListByOrder();
        //debug($priorities);die();
        $pageName = $this->pageName;
        $this->set(compact('projects', 'pageName', 'users', 'clients', 'priorities', 'projectStages'));
        $this->set('_serialize', ['projects']);
        $this->set('isSearch', $this->Projects->isSearch());
        
        /*$projects = $this->paginate($this->Projects);
        $pageName = $this->pageName;
        $this->set(compact('projects', 'pageName'));
        $this->set('_serialize', ['projects']);*/
    }

    /**
     * View method
     *
     * @param string|null $id Project id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null){
        $project = $this->Projects->get($id, [
            'contain' => ['Teams', 'Users' => ['queryBuilder' => function ($q) {
                                                            return $q->where(['AssocUsersProjects.accessLevel >' => '1']);
                                                        }], 'Clients', 'Priorities', 'ProjectStages', 'Criterions', 'ProjectUrls']
        ]);
        //debug($this->Projects->getProjectDataById($id));die();
        $this->loadModel('Users');
        $user_id = $this->Projects->AssocUsersProjects->getProjectManagerByIdProject($id);
        $projectManager = $this->Users->getUserDataById($user_id);
        //debug($projectManager);die();
        $pageName = $this->pageName;
        $this->set(compact('pageName', 'projectManager'));
        $this->set('project', $project);
        $this->set('_serialize', ['project']);
    }

    public function viewDoc($id, $name){
        $project = $this->Projects->get($id);
        $url = $project->path_dir . $name;
        $this->response->file(PROJECTS_UPLOAD . DS . $project->path_dir . DS . $name, ['download' => true]);
        return $this->response;
    }
    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function getDateTimeFormat($datetime) {
        if(strlen($datetime) !== 16) return Null;
        $array_datetime['day'] = substr($datetime, 0, 2);
        $array_datetime['month'] = substr($datetime, 3, 2);
        $array_datetime['year'] = substr($datetime, 6, 4);
        $array_datetime['hour'] = substr($datetime, 11, 2);
        $array_datetime['minute'] = substr($datetime, 14, 2);
        //debug($array_datetime);die();
        return $array_datetime;
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
    
    private function criterions_update($criterions, $project_id){
        foreach ($criterions as $key => $criterion) {
            $assoc_id = $this->Projects->AssocProjectsCriterions->getAssocIdByCriterionAndProject($key, $project_id);
            $this->Projects->AssocProjectsCriterions->update_content($assoc_id, $criterion);
        }
    }
    
    private function criterions_update_percent($criterions_percent, $project_id){
        foreach ($criterions_percent as $key => $percent) {
            $assoc_id = $this->Projects->AssocProjectsCriterions->getAssocIdByCriterionAndProject($key, $project_id);
            $this->Projects->AssocProjectsCriterions->update_percent($assoc_id, $percent);
        }
    }
    
    private function usersInTeams($team_ids, $user_ids){
        $this->loadModel('Users');
        $i = 0;
        $inTeam = true;
        while(isset($user_ids[$i])&&($inTeam)){
            $inTeam = $this->Users->userInTeams($user_ids[$i], $team_ids);
            $i++;
        }
        if($inTeam){return true;}else{return false;}
    }
    
    private function projectManager_exitinlist($chefproject_id, $listemployees){
        if((!isset($chefproject_id))&&($chefproject_id === null))
            return true;
        return (\in_array($chefproject_id, $listemployees)) ? true : false;
    }
    
    public function add(){
        $project = $this->Projects->newEntity();
        if ($this->request->is('post')){
            
            $usersInTeams = false;
            $projectManager_exitinlist = false;
            if(isset($this->request->data['employees'])){
                $user_ids = $this->request->data['employees'];
                //$user_ids[] = 5550;
                $this->request->data['users']['_ids'] = $user_ids;
                //tester si tout les users correspondent aux équipes selectionnées
                $usersInTeams = $this->usersInTeams($this->request->data['teams']['_ids'], $user_ids);
            }
            
            //S'il y a des critères :
            if((!empty($this->request->data['criterions']))||(!empty($this->request->data['criterions_percent']))){
                $criterions_data = $this->criterions_handle($this->request->data['criterions'], $this->request->data['criterions_percent']);
                unset($this->request->data['criterions']);
                if($criterions_data['criterions_ids'] !== null) {
                    $this->request->data['criterions']['_ids'] = $criterions_data['criterions_ids'];
                } 
            }
            
            if(isset($this->request->data['users']['_ids'])){
                $this->request->data['chefproject'] = (isset($this->request->data['chefproject'])&&($this->request->data['chefproject'] !== '')) ? $this->request->data['chefproject'] : null;
                $projectManager_exitinlist = $this->projectManager_exitinlist($this->request->data['chefproject'], $this->request->data['users']['_ids']);
            }
            
            $this->request->data['dateBegin'] = $this->getDateTimeFormat($this->request->data['dateBegin']);
            $this->request->data['dateEnd'] = $this->getDateTimeFormat($this->request->data['dateEnd']);
            //debug($this->request->data); die();
            $project = $this->Projects->patchEntity($project, $this->request->data);
            $conn = ConnectionManager::get('default');
            $conn->begin();
            //S'il exite des employés && tout les employés ont des équipes séléctionnées && le chef du projet exite dans la liste && le projet a été sauvegarder sans problème
            if ((isset($this->request->data['employees']))&&($usersInTeams)&&($projectManager_exitinlist)&&($result = $this->Projects->save($project))){
                try {
                    $project_id = $result->id;
                    if(isset($this->request->data['employees'])){
                        foreach ($this->request->data['employees'] as $key => $employee) {
                            $field_name = 'time-dedicated-'.$employee;
                            $time_dedicated = $this->request->data[$field_name];
                            $assoc_id = $this->Projects->AssocUsersProjects->getAssocIdByUserAndProject($employee, $project_id);
                            $this->Projects->AssocUsersProjects->update_timededicated($assoc_id, $time_dedicated);
                            if($employee == $this->request->data['chefproject']){
                                $this->Projects->AssocUsersProjects->update_projectManager($assoc_id, 1);
                            }
                        }
                    }
                    //S'il y a des critères :
                    if(!empty($this->request->data['criterions'])){
                        $this->criterions_update($criterions_data['criterions'], $project_id);
                    }
                    if((isset($criterions_data['criterions_percent']))&&(!empty($criterions_data['criterions_percent']))){
                        $this->criterions_update_percent($criterions_data['criterions_percent'], $project_id);
                    }
                    
                    if((!empty($this->request->data['path_doc'][0]['name'])) && ($this->request->data['path_doc'][0]['name'] !== '')){
                        $this->file_upload($result->id, $this->request->data);
                    }
                    $this->Flash->success(__('has been saved.', ['Le ', __('project'), '']));
                    $conn->commit();
                } catch (\Exception $e) {
                    $conn->rollback();
                    $this->Flash->error(__('could not be saved. Please, try again.', ['Le ', __('project'), '']));
                }
                return $this->redirect(['action' => 'index']);
            }else{
                $this->Flash->error(__('could not be saved. Please, try again.', ['Le ', __('project'), '']));
            }
        }
        $this->loadModel('Users');
        $this->loadModel('Clients');
        $this->loadModel('AssocTeamsUsers');
        $clients = $this->Clients->getClientsList();
        $employees = $this->Users->getEmployeesList();
        $teams = $this->Projects->Teams->getTeamsHaveDepList();
        $priorities = $this->Projects->Priorities->getPrioritiesListByOrder();
        $stages = $this->Projects->ProjectStages->getStagesListByOrder();
        $usersbyteam = $this->AssocTeamsUsers->getUsersByTeams();
        $criterions = $this->Projects->Criterions->getCriterionsOfProducts();
        
        $this->set(compact('project', 'teams', 'clients', 'employees', 'usersbyteam', 'priorities', 'stages', 'criterions'));
        $this->set('_serialize', ['project']);
    }
    
    
    /**
     * 
     * @param type $id
     * @param type $data
     */
    private function file_upload($id, $data){
        //upload image
        $folderName = $id.'-'.$this->slug($data['name']);
        $pathToDir = $this->dir_projects.DS.$folderName;
        
        if (!file_exists($pathToDir)){
            mkdir($pathToDir, 0777, true);
        }
        foreach($data['path_doc'] as $key => $value){
            //Remplacer les espaces par '_'
            $fileToUpload = $value;
            $fileToUpload['name'] = str_replace(' ', '_', $fileToUpload['name']);
            //Récuperation du racine et ajout d'un prefixe id pour chaque doc
            $path = $pathToDir . DS . $id . '_' .$fileToUpload['name'];
            //Upload
            if((move_uploaded_file($fileToUpload['tmp_name'], $path))){
            }else{
                $this->Flash->error(__('Doc upload : problem.'));
            }
        }
        $projectUpdate = $this->Projects->get($id);
        $projectUpdate->path_dir = $folderName;
        $this->Projects->save($projectUpdate);
    }

    public function keepNotMemberAssociation($members, $notMembers) {
        
    }
    /**
     * Edit method
     *
     * @param string|null $id Project id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        //$this->viewBuilder()->layout('dashboard');
        $project = $this->Projects->get($id, [
            'contain' => ['Teams', 'Users'  => ['queryBuilder' => function ($q) {
                                                            return $q->where(['AssocUsersProjects.accessLevel >' => '1']);
                                                        }], 'Clients', 'Criterions']
        ]);
        //debug($projectNotMember['users']);die();
        if ($this->request->is(['patch', 'post', 'put'])) {
            //debug($this->request->data); die();
            $usersInTeams = false;
            $projectManager_exitinlist = false;
            if(isset($this->request->data['employees'])){
                $user_ids = $this->request->data['employees'];
                $this->request->data['users']['_ids'] = $user_ids;
                //tester si tout les users correspondent aux équipes selectionnées
                $usersInTeams = $this->usersInTeams($this->request->data['teams']['_ids'], $user_ids);
            }
            //S'il y a des critères :
            if((!empty($this->request->data['criterions']))||(!empty($this->request->data['criterions_percent']))){
                $criterions_data = $this->criterions_handle($this->request->data['criterions'], $this->request->data['criterions_percent']);
                unset($this->request->data['criterions']);
                if($criterions_data['criterions_ids'] !== null) {
                    $this->request->data['criterions']['_ids'] = $criterions_data['criterions_ids'];
                } 
            }
            
            if(isset($this->request->data['users']['_ids'])){
                $this->request->data['chefproject'] = (isset($this->request->data['chefproject'])&&($this->request->data['chefproject'] !== '')) ? $this->request->data['chefproject'] : null;
                $notMembersIdsOfThisProject = $this->Projects->getNotMembersProject($id); // Les users qui ont access Level mois que 2
                $this->request->data['users']['_ids'] = array_merge($this->request->data['users']['_ids'], $notMembersIdsOfThisProject);
                $projectManager_exitinlist = $this->projectManager_exitinlist($this->request->data['chefproject'], $this->request->data['users']['_ids']);
            }
            //debug($this->request->data['users']['_ids']);die();
            //$this->request->data['users']['_ids'][] = 1;
            
            $this->request->data['dateBegin'] = $this->getDateTimeFormat($this->request->data['dateBegin']);
            $this->request->data['dateEnd'] = $this->getDateTimeFormat($this->request->data['dateEnd']);
            $project = $this->Projects->patchEntity($project, $this->request->data);
            $conn = ConnectionManager::get('default');
            $conn->begin();
            if (($projectManager_exitinlist) && ($usersInTeams) && ($this->Projects->save($project))) {
                
                try {
                    $project_id = $id;
                    $this->loadModel('ProjectEmployeeInfos');
                    $this->Projects->AssocUsersProjects->update_projectManagerSetNull($project_id);
                    foreach ($this->request->data['employees'] as $key => $employee) {
                        $field_name = 'time-dedicated-'.$employee;
                        $time_dedicated = $this->request->data[$field_name];
                        $assoc_id = $this->Projects->AssocUsersProjects->getAssocIdByUserAndProject($employee, $project_id);
                        $this->Projects->AssocUsersProjects->update_timededicated($assoc_id, $time_dedicated);
                        if($employee == $this->request->data['chefproject']){
                            $this->Projects->AssocUsersProjects->update_projectManager($assoc_id, 1);
                        }
                    }
                    
                    //S'il y a des critères :
                    if(!empty($this->request->data['criterions'])){
                        $this->criterions_update($criterions_data['criterions'], $project_id);
                    }
                    if((isset($criterions_data['criterions_percent']))&&(!empty($criterions_data['criterions_percent']))){
                        $this->criterions_update_percent($criterions_data['criterions_percent'], $project_id);
                    }
                    
                    if((!empty($this->request->data['path_doc'][0]['name'])) && ($this->request->data['path_doc'][0]['name'] !== '')){
                        $this->file_upload($project_id, $this->request->data);
                    }
                    $this->Flash->success(__('has been saved.', ['Le ', __('project'), '']));
                    $conn->commit();
                } catch (\Exception $e) {
                    $conn->rollback();
                    $this->Flash->error(__('could not be saved. Please, try again.', ['Le ', __('project'), '']));
                }
                return $this->redirect(['action' => 'view', $id]);
                
            } else {
                $this->Flash->error(__('could not be saved. Please, try again.', ['Le ', __('project'), '']));
            }
        }
        //Get project files
        $files = $project->path_dir !== null ? $this->Projects->getFilesByProjects($project->path_dir) : null;
        
        $this->loadModel('Users');
        $this->loadModel('Clients');
        $this->loadModel('AssocTeamsUsers');
        $clients = $this->Clients->getClientsList();
        $employees = $this->Users->getEmployeesList();
        $employees_thisproject = $this->Projects->AssocUsersProjects->getIdsUsersByprojectId($id);
        $time_dedicated_byIds = $this->Projects->AssocUsersProjects->getTimesDedicatedByIdProjects($id);
        $projectManager_id = $this->Projects->AssocUsersProjects->getProjectManagerByIdProject($id);
        $priorities = $this->Projects->Priorities->getPrioritiesListByOrder();
        $stages = $this->Projects->ProjectStages->getStagesListByOrder();
        $teams = $this->Projects->Teams->getTeamsHaveDepList();
        $usersbyteam = $this->AssocTeamsUsers->getUsersByTeams();
        $criterions = $this->Projects->Criterions->getCriterionsOfProducts();
        $content_byIds = $this->Projects->AssocProjectsCriterions->getContentByIdProject($id);
        $percent_byIds = $this->Projects->AssocProjectsCriterions->getPercentByIdProject($id);
        $this->set(compact('project', 'criterions', 'content_byIds', 'files', 'percent_byIds', 'projectManager_id', 'teams', 'clients', 'employees', 'usersbyteam', 'employees_thisproject', 'time_dedicated_byIds', 'priorities', 'stages'));
        $this->set('_serialize', ['project']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Project id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $project = $this->Projects->get($id);
        if ($this->Projects->delete($project)) {
            if(isset($project->path_dir)){
                $path_file = $this->dir_projects.DS.$project->path_dir;
                if(file_exists($path_file)){
                    //effacer tous les fichiers
                    array_map('unlink', glob("$path_file/*.*"));
                    //effacer le dossier
                    rmdir($path_file);
                }    
            }
            $this->Flash->success(__('has been deleted.', ['Le ', __('project'), '']));
        } else {
            $this->Flash->error(__('could not be deleted. Please, try again.', ['Le ', __('project'), '']));
        }
        return $this->redirect(['action' => 'index']);
    }
    
    
    public function deletefile($path_dir, $namefile) {
        $msg = '';
        if (isset($path_dir)&&(isset($namefile))) {
            $path_file = $this->dir_projects.DS.$path_dir.DS.$namefile;
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
    /*public function getNumberProjectsByDep(){
        $projects = $this->Projects->find('all')->contain(['Teams'])->group('Projects.Teams.name')->toArray();
        debug($projects); die();
        return $projects;
    }*/
}
