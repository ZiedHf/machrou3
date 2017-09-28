<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\I18n\FrozenTime;
use Cake\Routing\Router;

use Cake\Event\Event;
/**
 * Consults Controller
 *
 * @property \App\Model\Table\ConsultssTable $Consults
 */
class ConsultController extends AppController
{

    public function initialize(){
        parent::initialize();
        //$this->loadHelper('Html');
        $this->pageName = 'consult';

        $this->loadModel('Companies');
        $this->loadModel('Departements');
        $this->loadModel('Projects');
        $this->loadModel('Teams');
        $this->loadModel('Users');
        $this->loadModel('Clients');
        $this->loadModel('ProjectStages');

        //$this->viewBuilder()->layout('dashgumfree');
        $this->viewBuilder()->layout('consult');

        $this->user_type = $this->Auth->user('type');
        if($this->user_type == 'user'){
            $this->user_id = $this->Auth->user('user_id');
        }elseif($this->user_type == 'member'){
            $this->user_id = $this->Auth->user('member_id');
        }
    }

    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        //$this->Auth->allow(['index']);
    }

    public function isAuthorized($user = null){
        if(parent::isAuthorized($user)){
            return true;
        }
        //Autorisation pour le user et les membres
        /*
        if((isset($user['type']))&&(($user['type'] === 'user')||($user['type'] === 'member'))){
            if(in_array($this->request->action, ['clientsList', 'viewClientInfo'])) {
                if($user['clients_manager']){
                    return true;
                }
            }
        }
        */
        //Autorisation pour le client
        if((isset($user['type']))&&($user['type'] === 'client')){
            if(in_array($this->request->action, ['index', 'projectsList', 'clientsList'])) {
                return true;
            }
            if($this->request->action == 'viewProjectInfo') {
                //debug($this->request->params->pass[1]); die();
                $project_id = $this->request->params['pass'][1];
                if($this->Projects->isOwnedBy($project_id, $user['client_id'], 'client')){
                    return true;
                }
            }elseif($this->request->action == 'viewClientInfo'){
                $client_id = $this->request->params['pass'][0];
                if($user['client_id'] == $client_id){
                    return true;
                }
            }
        //Autorisation pour le user
        }elseif((isset($user['type']))&&(($user['type'] === 'user')||($user['type'] === 'member'))){
            $sessionUserId = ($user['type'] === 'user') ? $user['user_id'] : $user['member_id'];

            if(in_array($this->request->action, ['clientsList', 'viewClientInfo'])) {
                if($user['clients_manager']){
                    return true;
                }
            }elseif(in_array($this->request->action, ['index', 'companies','departements', 'teamsList', 'projectsList', 'employeesList'])) {
                return true;
            }elseif($this->request->action == 'viewDepartement'){
                $departementsController = New DepartementsController;
                $dep_id = $this->request->params['pass'][0];
                $haveAccessRightResult = $departementsController->haveAccessRight($user, $dep_id, $this->request->action);
                //debug($haveAccessRightResult);die();
                if($haveAccessRightResult === 'DENIED'){
                    return false;
                }elseif($haveAccessRightResult){
                    return true;
                }
                if($user['type'] === 'user'){
                    $userTeams = $this->Users->getUserTeams($user['user_id']);
                    $depsOfUser = $this->return_array($userTeams->teams, 'departement_id');
                    if((isset($depsOfUser))&&(in_array($dep_id, $depsOfUser))){
                        return true;
                    }
                }

            }elseif($this->request->action == 'viewTeamInfo'){
                $teamsController = New TeamsController;
                $team_id = $this->request->params['pass'][0];
                $haveAccessRightResult = $teamsController->haveAccessRight($user, $team_id, $this->request->action);
                if($haveAccessRightResult === 'DENIED'){
                    return false;
                }elseif($haveAccessRightResult){
                    return true;
                }
                if($user['type'] === 'user'){
                    $userTeams = $this->Users->getUserTeams($user['user_id']);
                    $teamsOfUser = $this->return_array($userTeams->teams, 'id');
                    if((isset($teamsOfUser))&&(in_array($team_id, $teamsOfUser))){
                        return true;
                    }
                }
            }elseif($this->request->action == 'viewTeam'){
                $teamsController = New TeamsController;
                $team_id = $this->request->params['pass'][1];
                $haveAccessRightResult = $teamsController->haveAccessRight($user, $team_id, $this->request->action);
                if($haveAccessRightResult === 'DENIED'){
                    return false;
                }elseif($haveAccessRightResult){
                    return true;
                }
                if($user['type'] === 'user'){
                    $userTeams = $this->Users->getUserTeams($user['user_id']);
                    $teamsOfUser = $this->return_array($userTeams->teams, 'id');
                    if((isset($teamsOfUser))&&(in_array($team_id, $teamsOfUser))){
                        return true;
                    }
                }
            }elseif($this->request->action == 'viewUserInfo'){
                $user_id = $this->request->params['pass'][0];
                if($user_id == $user['user_id']){
                    return true;
                }
            }elseif($this->request->action == 'viewUser'){
                $user_id = $this->request->params['pass'][1];
                if($user_id == $user['user_id']){
                    return true;
                }
            }elseif(in_array($this->request->action, ['viewProjectInfo', 'viewProject'])) {
                $projectsController = New ProjectsController;
                $project_id = $this->request->params['pass'][1];
                $haveAccessRightResult = $projectsController->haveAccessRight($user, $project_id, $this->request->action);
                if($haveAccessRightResult === 'DENIED'){
                    return false;
                }elseif($haveAccessRightResult){
                    return true;
                }
                if(($user['type'] === 'user')&&($this->Projects->isOwnedBy($project_id, $user['user_id'], 'user'))){
                    return true;
                }
            }
        //Autorisation pour le member
        }/*elseif((isset($user['type']))&&($user['type'] === 'member')){
            if(in_array($this->request->action, ['index', 'departements', 'teamsList', 'projectsList', 'employeesList', 'clientsList', 'calendar'])) {
                return true;
            }
        }*/

        return false;
    }

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index(){
        //$departements = $this->Departements->getAllDepData();

        $departements = $this->Departements->getAllDepDataOfThisUser($this->user_type, $this->user_id, $this->Auth->user('group_manager'));
        $projects = $this->Projects->getAllProjectDataByUser(null, $this->user_type, $this->user_id, $this->Auth->user('group_manager'));

        //$projects = $this->Projects->getAllProjectDataByDepByUser();
        $project_ids = array();
        foreach ($projects as $key => $project) {
            $project_ids[] = $project->id;
        }
        //$projectStages = $this->ProjectStages->getCountProjectsByStages(0); //have more than 0 project
        $projectStages = $this->ProjectStages->getCountProjectsByStagesByUser(0, $this->user_type, $this->user_id, $this->Auth->user('group_manager')); //have more than 0 project
        /*$projectStages = $this->ProjectStages->getAllstages();*/
        //debug($this->Auth->user());die();
        //$this->viewBuilder()->layout('consult2');
        //$this->viewBuilder()->layout('dashgumfree');
        $info_charts = null;
        foreach($departements as $keyDep => $departement){
            //if($departement->id == 9) {debug($departement);die();}
            foreach ($departement->teams as $keyTeam => $team){
                foreach ($team->projects as $keyProject => $project){
                    if(in_array($project->id, $project_ids)){
                        $info_charts[$keyDep]['departement'] = $departement['name'];
                        $info_charts[$keyDep]['id'] = $departement['id'];
                        $info_charts[$keyDep]['projects'][$keyProject]['projet'] = $project['name'];
                        $info_charts[$keyDep]['projects'][$keyProject]['accomplishment'] = $project['accomplishment'];
                    }
                }
            }
        }
        //debug($info_charts); die();
        $cakeDescription = "Gestion des projets";
        //$numberDeps = $this->Departements->getCountDep();
        $numberDeps = count($departements);
        $numberClients = $this->Clients->getCountClients();
        $numberTeams = $this->Teams->getCountTeamsByUser($this->user_type, $this->user_id, $this->Auth->user('group_manager'));
        $numberEmp = $this->Users->getCountEmpByUser($this->user_type, $this->user_id, $this->Auth->user('group_manager'));

        $numberProjects = $this->Projects->getCountProjectsByUser($this->user_type, $this->user_id, $this->Auth->user('group_manager'));
        $arrayNumber = array('numberDeps' => $numberDeps, 'numberTeams' => $numberTeams, 'numberEmp' => $numberEmp, 'numberProjects' => $numberProjects, 'numberClients' => $numberClients);
        //debug($numberProjects);die();
        //$departements = $this->paginate($this->Departements);
        $pageName = 'Dashboard';
        $this->set(compact('departements', 'projects', 'cakeDescription', 'pageName', 'arrayNumber', 'info_charts', 'projectStages'));
        //$this->set('_serialize', ['departements']);
    }

    public function companies($id = null)
    {
        //$companies = $this->Companies->getAllCompaniesData();
        $companies = $this->Companies->getAllCompaniesDataByUser($this->user_type, $this->user_id, $this->Auth->user('group_manager'));
        $companies = $companies->toArray();
        //debug($companies);die();
        /*

        foreach($departements as $keyDep => $departement){
            $dep_id = $departement['id'];
            $departements[$keyDep]['numberTeams'] = $this->Departements->getCountTeamsByDep($dep_id);
            $departements[$keyDep]['numberUsers'] = $this->Departements->getCountUsersByDep($dep_id);
            $departements[$keyDep]['numberProjects'] = $this->Departements->getCountProjectsByDep($dep_id);
            $departements[$keyDep]['employees'] = $this->Users->getUsersByIdDep($dep_id);
        }
        */
        //$numberCompanies = $this->Companies->getCountDep();
        $numberCompanies = count($companies);
        $pageName = 'Companies';
        $this->set(compact('numberCompanies', 'companies', 'pageName'));
    }

    public function departements($id = null)
    {
        //$departements = $this->Departements->getAllDep();
        $departements = $this->Departements->departementsOfThisUser($this->user_type, $this->user_id, $this->Auth->user('group_manager'));
        $departements = (isset($departements)) ? $departements->toArray() : array();

        foreach($departements as $keyDep => $departement){
            $dep_id = $departement['id'];
            $departements[$keyDep]['numberTeams'] = $this->Departements->getCountTeamsByDep($dep_id);
            $departements[$keyDep]['numberUsers'] = $this->Departements->getCountUsersByDep($dep_id);
            $departements[$keyDep]['numberProjects'] = $this->Departements->getCountProjectsByDep($dep_id);
            $departements[$keyDep]['employees'] = $this->Users->getUsersByIdDep($dep_id);
        }
        //debug($departements); die();
        //$numberDepartements = $this->Departements->getCountDep();
        $numberDepartements = count($departements);
        $pageName = 'Départements';
        $this->set(compact('departements', 'projects', 'cakeDescription', 'pageName', 'arrayNumber', 'numberDepartements'));
        //$this->set('_serialize', ['departements']);
    }

    public function viewDepartement($id) {
        $departement = $this->Departements->getThisDepDataByUser($id, $this->user_type, $this->user_id, $this->Auth->user('group_manager'));
        $projects = $this->Projects->getAllProjectDataByDep($id);
        //debug($departement);die();
        $files = null;
        foreach ($projects as $key => $project) {
            if($project->path_dir !== null){
                $project_id = $project->id;
                $files[$project_id] = $this->Projects->getFilesByProjects($project->path_dir); // les noms des dossiers seulement
            }
        }

        $this->loadModel('Priorities');
        $this->loadModel('ProjectStages');
        $stages = $this->ProjectStages->getStagesListByOrder()->toArray();
        $priorities = $this->Priorities->getPrioritiesListByOrder()->toArray();
        $action = 'viewProject';
        $pageName = 'Départements';
        $this->set(compact('pageName', 'departement', 'files', 'action', 'stages', 'priorities'));
    }

    public function viewProject($dep_id, $project_id) {
        $departement = ($dep_id > 0) ? $this->Departements->getThisDepData($dep_id) : null;
        $project = $this->Projects->getAllProjectDataById($project_id);
        //Get Project Manager
        $this->loadModel('AssocUsersProjects');
        $projectManager_id = $this->AssocUsersProjects->getProjectManagerByIdProject($project->id);
        $projectManager = $this->Projects->Users->getUserDataById($projectManager_id);
        //Get Files
        $files = $this->Projects->getFilesByProjects($project->path_dir); // les noms des dossiers seulement
        $images = $this->getImagesFiles($files);
        //debug($files); die();
        $pageName = 'Départements';
        $this->set(compact('pageName', 'departement', 'project', 'files', 'images', 'projectManager'));
    }

    public function viewUser($dep_id, $user_id) {
        $departement = $this->Departements->getThisDepData($dep_id);
        $user = $this->Users->getAllUserDataById($user_id);

        $pageName = 'Départements';
        $this->set(compact('pageName', 'departement', 'user'));
    }

    public function viewTeam($dep_id, $team_id) {
        $departement = $this->Departements->getThisDepData($dep_id);
        $team = $this->Teams->getTeamDataById($team_id);
        //debug($team); die();
        $pageName = 'Départements';
        $this->set(compact('pageName', 'departement', 'team'));
    }

    public function teamsList() {
        $teams = $this->Teams->getTeamsDataByUser($this->user_type, $this->user_id, $this->Auth->user('group_manager'))->toArray();
        foreach ($teams as $key => $team) {
            $id = $team['id'];
            $teams[$key]['numberProjects'] = $this->Teams->getCountProjectsByTeam($id);
            $teams[$key]['numberUsers'] = $this->Teams->getCountUsersByTeam($id);
        }

        //$numberteams = $this->Teams->getCountTeams();
        $numberteams = count($teams);
        $pageName = 'Equipes';
        $this->set(compact('pageName', 'teams', 'numberteams'));
    }
    public function viewTeamInfo($id) {
        //$team = $this->Teams->getTeamDataById($id);
        $team = $this->Teams->getThisTeamDataByUser($id, $this->user_type, $this->user_id, $this->Auth->user('group_manager'));
        //debug($team);die();
        $pageName = 'Equipes';
        $this->set(compact('pageName', 'team'));
    }

    public function projectsList($stage_id = null) {
        //$projects = $this->Projects->getAllProjectData();
        //$projects = $this->Projects->getAllProjectData($stage_id);
        $projects = $this->Projects->getAllProjectDataByUser($stage_id, $this->user_type, $this->user_id, $this->Auth->user('group_manager'));
        //();
        //debug($projects);die();
        //$numberProjects = $this->Projects->getCountProjects();
        $numberProjects = count($projects);
        $files = null;
        foreach ($projects as $key => $project) {
            if($project->path_dir !== null){
                $project_id = $project->id;
                $files[$project_id] = $this->Projects->getFilesByProjects($project->path_dir); // les noms des dossiers seulement
            }
        }

        $this->loadModel('Priorities');
        $this->loadModel('ProjectStages');
        $stages = $this->ProjectStages->getStagesListByOrder()->toArray();
        $priorities = $this->Priorities->getPrioritiesListByOrder()->toArray();

        $pageName = 'Projets';
        $action = 'viewProjectInfo';
        $this->set(compact('pageName', 'projects', 'numberProjects', 'files', 'action', 'priorities', 'stages'));
    }

    public function viewProjectInfo($dep_id = null, $project_id) {
        $project = $this->Projects->getAllProjectDataById($project_id);
        $this->loadModel('AssocUsersProjects');
        $projectManager_id = $this->AssocUsersProjects->getProjectManagerByIdProject($project->id);
        $projectManager = $this->Projects->Users->getUserDataById($projectManager_id);

        //debug($projectManager);die();
        $files = $this->Projects->getFilesByProjects($project->path_dir); // les noms des dossiers seulement
        $images = $this->getImagesFiles($files);
        $pageName = 'Projets';

        $this->set(compact('pageName', 'project', 'files', 'images', 'projectManager'));
    }

    public function employeesList() {
        $employees = $this->Users->getAllEmployeesDataByUser($this->user_type, $this->user_id, $this->Auth->user('group_manager'));
        //$numberEmp = $this->Users->getCountEmp();
        $numberEmp = count($employees);
        $pageName = 'Employés';

        $this->set(compact('pageName', 'employees', 'numberEmp'));
    }

    public function viewUserInfo($id) {
        $user = $this->Users->getAllUserDataById($id);
        $pageName = 'Employés';
        //debug($user); die();
        $this->set(compact('pageName', 'user'));
    }

    public function clientsList() {
        $clients = $this->Clients->getAllClientsData();
        $numberClients = $this->Clients->getCountClients();
        $pageName = 'Clients';

        $this->set(compact('pageName', 'clients', 'numberClients'));
    }

    public function viewClientInfo($id) {
        $client = $this->Clients->getAllClientDataById($id);
        //debug($client);die();
        $pageName = 'Clients';
        $this->set(compact('pageName', 'client'));
    }

    public function calendar() {
        $projects_db = $this->Projects->calendar_projectsData();
        $i = 0;
        foreach ($projects_db as $key => $project) {
            if((isset($project['dateBegin']))||(isset($project['dateEnd']))){
                $projects[$i]['id'] = $project['id'];
                $projects[$i]['title'] = $project['name'];
                //if(isset($project['dateBegin'])) {$projects[$i]['start'] = $project['dateBegin']->i18nFormat('YYYY/M/dd HH:mm');}
                if(isset($project['dateBegin'])) {$projects[$i]['start'] = $project['dateBegin']->i18nFormat('YYYY-MM-d HH:mm');}

                //if(isset($project['dateBegin'])) {$projects[$i]['start'] = '2016-11-18T08:00:00';}
                //debug($projects[$i]['start']); die();
                //if(isset($project['dateEnd'])) {$projects[$i]['end'] = $project['dateEnd']->i18nFormat('YYYY/M/dd HH:mm');}
                if(isset($project['dateEnd'])) {$projects[$i]['end'] = $project['dateEnd']->i18nFormat('YYYY-MM-d HH:mm');}
                //if(isset($project['dateEnd'])) {$projects[$i]['end'] = '2016-11-20T18:00:00';}
                $projects[$i]['url'] = Router::url([
                                            'controller' => 'Consult',
                                            'action' => 'viewProjectInfo',
                                            0,
                                            $project['id']
                                            ],TRUE);
                $projects[$i]['editable'] = false;
                //$projects[$i]['color'] = 'red';
                //$projects[$i]['allDay'] = true;
                $i++;
            }
        }
        //debug(Router::$this->Url->build(['controller' => 'Consult', 'action' => 'index']));die();
        //debug($projects); die();
        $pageName = 'Calendar';
        $this->set(compact('pageName', 'projects'));
    }
}
