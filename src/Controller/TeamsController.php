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
 * Teams Controller
 *
 * @property \App\Model\Table\TeamsTable $Teams
 */
class TeamsController extends AppController
{

    public function initialize() {
        parent::initialize();
        $this->pageName = 'Teams';
        $this->dir = TEAMS_UPLOAD;
        $this->loadComponent('Search.Prg', ['actions' => ['index', 'lookup']]);

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

        $team_id = (isset($this->request->params['pass'][0])) ? $this->request->params['pass'][0] : null;
        $haveAccessRight = $this->haveAccessRight($user, $team_id);
        if($haveAccessRight === 'DENIED'){
            return false;
        }
        if($haveAccessRight){
            return true;
        }

        if((isset($user['type']))&&(($user['type'] === 'user')||($user['type'] === 'member'))){
            if($this->request->action == 'add'){
                if($this->request->is(['patch', 'post', 'put'])) {
                    //debug($this->request->data['company_id']);die();
                    $sessionUserId = ($user['type'] === 'user') ? $user['user_id'] : $user['member_id'];
                    $dep_id = (isset($this->request->data['departement_id'])) ? $this->request->data['departement_id'] : null;
                    $isDepartementManager = (isset($dep_id)) ? $this->Teams->Departements->isDepartementManager($sessionUserId, $dep_id, $user['type']) : null;
                    $company_id = $this->Teams->Departements->getThisDepCompany($dep_id);
                    $isCompanyManager = (isset($company_id)) ? $this->Teams->Departements->Companies->isCompanyManager($sessionUserId, $company_id, $user['type']) : null;
                    if(($isDepartementManager)||($isCompanyManager)){
                        return true;
                    }
                }
            }
        }
            /*
             * Donner l'access à tous les membres de projet sans exception
            if($this->request->action == 'view'){
                $team_id = $this->request->params['pass'][0];
                $users_team = $this->Teams->getusers_team($team_id);
                if(in_array($user['user_id'], $users_team)){
                    return true;
                }
            }*/
            //Autorisation pour les membres
        /*}*//*elseif((isset($user['type']))&&($user['type'] === 'member')){
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
    public function haveAccessRight($user, $team_id, $action = null) {
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
        //Si l'action est add = test s'il est un Manager d'un departement ou une societé
        if((in_array($this->request->action, ['add']))&&(($this->Teams->Departements->heIsADepartementManager($sessionUserId, $user['type']))||($this->Teams->Departements->Companies->heIsACompanyManager($sessionUserId, $user['type'])))) {
            if(!($this->request->is(['patch', 'post', 'put']))){
                return true;
            }
            return false;//Pas nécessaire de terminer cette fonction
        }

        //Celui ci est un CompanyManager = a l'access
        $company_id = (isset($team_id)) ? $this->Teams->getThisTeamCompanyId($team_id) : null;

        $isCompanyManager = (isset($company_id)) ? $this->Teams->Departements->Companies->isCompanyManager($sessionUserId, $company_id, $user['type']) : 0;
        if($isCompanyManager){
            return true;
        }

        $accessLevel = (isset($company_id)) ? $this->Teams->Departements->Companies->getUserAccessByCompany($sessionUserId, $user['type'], $company_id) : null;
        if(($accessLevel === 2)||($accessLevel === 0)){
            return 'DENIED';
        }
        if($this->allowByAccessLevelAndAction($accessLevel, $action)){
            return true;
        }
        //Departement Manager
        $departement_id = (isset($team_id)) ? $this->Teams->getThisTeamDepId($team_id) : null;
        $isDepartementManager = (isset($departement_id)) ? $this->Teams->Departements->isDepartementManager($sessionUserId, $departement_id, $user['type']) : 0;

        if($isDepartementManager){
            return true;
        }

        $accessLevel = (isset($departement_id)) ? $this->Teams->Departements->getUserAccessByDepartement($sessionUserId, $user['type'], $departement_id) : null;
        if(($accessLevel === 2)||($accessLevel === 0)){
            return 'DENIED';
        }
        if($this->allowByAccessLevelAndAction($accessLevel, $action)){
            return true;
        }
        //Get Access Level
        //debug($accessLevel);die();
        $isTeamManager = (isset($team_id)) ? $this->Teams->isTeamManager($sessionUserId, $team_id, $user['type']) : 0;
        if($isTeamManager){
            return true;
        }

        $accessLevel = (isset($team_id)) ? $this->Teams->getUserAccessByTeam($user['user_id'], $user['type'], $team_id) : null;
        if(($accessLevel === 2)||($accessLevel === 0)){
            return 'DENIED';
        }
        if($this->allowByAccessLevelAndAction($accessLevel, $action)){
            return true;
        }

        return false;
    }

    public function allowByAccessLevelAndAction($accessLevel, $action) {
        if((($this->request->action === 'view')||(in_array($action, ['teamView', 'teamViewInfo'])))&&($accessLevel > 0)){
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
//        $query = $this->Departements->departementsOfThisUser($this->user_type, $this->user_id, $this->Auth->user('group_manager'));
//        $query = $query->find('search', ['search' => $this->request->query]);
//        $departements = $this->paginate($query);

        //debug($teams);die();

        $this->paginate = [
            'contain' => ['Departements'],
            'maxLimit' => 15
        ];
        $query = $this->Teams->getTeamsDataByUser($this->user_type, $this->user_id, $this->Auth->user('group_manager'));
        $query = $query->find('search', ['search' => $this->request->query]);

        $teams = $this->paginate($query);

        $pageName = $this->pageName;
        $this->set(compact('teams', 'pageName'));
        $this->set('_serialize', ['teams']);
        $this->set('isSearch', $this->Teams->isSearch());
    }

    /**
     * View method
     *
     * @param string|null $id Team id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null){
        $team = $this->Teams->get($id, [
            'contain' => ['Departements', 'Departements.Companies', 'Projects', 'Users' => ['queryBuilder' => function ($q) {
                                                            return $q->where(['AssocTeamsUsers.accessLevel >' => '1']);
                                                        }], 'Criterions']
        ]);

        $pageName = $this->pageName;
        $this->set(compact('pageName'));
        $this->set('team', $team);
        $this->set('_serialize', ['team']);
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

    private function criterions_update($criterions, $team_id){
        foreach ($criterions as $key => $criterion) {
            $assoc_id = $this->Teams->AssocTeamsCriterions->getAssocIdByCriterionAndTeam($key, $team_id);
            $this->Teams->AssocTeamsCriterions->update_content($assoc_id, $criterion);
        }
    }

    private function criterions_update_percent($criterions_percent, $team_id){
        foreach ($criterions_percent as $key => $percent) {
            $assoc_id = $this->Teams->AssocTeamsCriterions->getAssocIdByCriterionAndTeam($key, $team_id);
            $this->Teams->AssocTeamsCriterions->update_percent($assoc_id, $percent);
        }
    }
    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add(){
        $team = $this->Teams->newEntity();
        if ($this->request->is('post')) {

            //S'il y a des critères :
            if((!empty($this->request->data['criterions']))||(!empty($this->request->data['criterions_percent']))){
                $criterions_data = $this->criterions_handle($this->request->data['criterions'], $this->request->data['criterions_percent']);
                unset($this->request->data['criterions']);
                if($criterions_data['criterions_ids'] !== null) {
                    $this->request->data['criterions']['_ids'] = $criterions_data['criterions_ids'];
                }
            }

            $team = $this->Teams->patchEntity($team, $this->request->data);
            $conn = ConnectionManager::get('default');
            $conn->begin();
            if ($result = $this->Teams->save($team)) {

                try {
                    $team_id = $result->id;
                    //S'il y a des critères :
                    if(!empty($this->request->data['criterions'])){
                        $this->criterions_update($criterions_data['criterions'], $team_id);
                    }
                    if((isset($criterions_data['criterions_percent']))&&(!empty($criterions_data['criterions_percent']))){
                        $this->criterions_update_percent($criterions_data['criterions_percent'], $team_id);
                    }

                    //set image path
                    $this->request->data['path_image'] = $team_id.'-'.$this->slug($this->request->data['name']);
                    $this->Teams->update_path_image($team_id, $this->request->data['path_image']);
                    //upload image
                    if((!empty($this->request->data['image']['name'])) && ($this->request->data['image']['name'] !== '')){
                        $this->app_file_upload($team_id, $this->request->data['image'], $this->request->data['path_image']);
                    }

                    $this->Flash->success(__('has been saved.', ['L\'', __('team'), 'e']));
                    $conn->commit();
                } catch (\Exception $e) {
                    $conn->rollback();
                    $this->Flash->error(__('could not be saved. Please, try again.', ['L\'', __('team'), 'e']));
                }
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('could not be saved. Please, try again.', ['L\'', __('team'), 'e']));
            }
        }
        $departements = $this->Teams->Departements->find('list');

        $users = $this->Teams->Users->find('list');
        //$projects = $this->Teams->Projects->find('list');
        $criterions = $this->Teams->Criterions->getCriterionsOfTeams();
        $pageName = $this->pageName;
        $this->set(compact('team', 'criterions', 'departements', 'users', 'projects', 'pageName'));
        $this->set('_serialize', ['team']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Team id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $team = $this->Teams->get($id, [
            'contain' => ['Users'  => ['queryBuilder' => function ($q) {
                                                            return $q->where(['AssocTeamsUsers.accessLevel >' => '1']);
                                                        }], 'Criterions']
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

            $notMembersIdsOfThisTeam = $this->Teams->getNotMembersTeam($id); // Les users qui ont access Level mois que 2
            if(empty($notMembersIdsOfThisTeam)){
                $notMembersIdsOfThisTeam = array();
            }

            if($this->request->data['users']['_ids'] == ''){
              unset($this->request->data['users']['_ids']);
            }
            if(isset($this->request->data['users']['_ids'])){
              $users_ofthisteam = array_merge($this->request->data['users']['_ids'], $notMembersIdsOfThisTeam);
            }elseif(!empty($notMembersIdsOfThisTeam)){
              $users_ofthisteam = $notMembersIdsOfThisTeam;
            }else{
              $users_ofthisteam = array();
            }
            //array_merge($test, $notMembersIdsOfThisTeam)

            $this->request->data['users']['_ids'] = $users_ofthisteam;

            $team = $this->Teams->patchEntity($team, $this->request->data);
            $conn = ConnectionManager::get('default');
            $conn->begin();
            if ($this->Teams->save($team)) {
                try {
                    $team_id = $id;
                    //S'il y a des critères :
                    if(!empty($this->request->data['criterions'])){
                        $this->criterions_update($criterions_data['criterions'], $team_id);
                    }
                    if((isset($criterions_data['criterions_percent']))&&(!empty($criterions_data['criterions_percent']))){
                        $this->criterions_update_percent($criterions_data['criterions_percent'], $team_id);
                    }
                    //Check if there is a file to upload
                    if((!empty($this->request->data['image']['name'])) && ($this->request->data['image']['name'] !== '')){
                        //check if the folder is empty or not exist
                        $dir = TEAMS_UPLOAD.DS.$team->path_image;
                        /*Pour les anciens teams == Debut*/
                        if($team->path_image == null){
                            $this->request->data['path_image'] = $team_id.'-'.$this->slug($team->name);
                            $this->Teams->update_path_image($team_id, $this->request->data['path_image']);
                            $path_dir = $this->request->data['path_image'];
                        }else{
                            $path_dir = $team->path_dir;
                        }

                        /*Pour les anciens teams == Fin*/
                        /*La premiere condition pour les anciens users == $user->path_image == null*/
                        if(($team->path_image == null)||((!file_exists($dir)) || (count(scandir($dir)) == 2))){
                            $this->app_file_upload($team_id, $this->request->data['image'], $path_dir);
                        }else{
                            $this->Flash->error(__('Doc upload : problem.'));
                        }
                    }

                    $this->Flash->success(__('has been saved.', ['L\'', __('team'), 'e']));
                    $conn->commit();
                } catch (\Exception $e) {
                    $conn->rollback();
                    $this->Flash->error(__('could not be saved. Please, try again.', ['L\'', __('team'), 'e']));
                }
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('could not be saved. Please, try again.', ['L\'', __('team'), 'e']));
            }
        }
        //debug($team->path_image); die();
        $files = $this->getFilesByDir(TEAMS_UPLOAD, $team->path_image);

        $departements = $this->Teams->Departements->find('list');
        $users = $this->Teams->Users->find('list');
        //$projects = $this->Teams->Projects->find('list');
        $criterions = $this->Teams->Criterions->getCriterionsOfTeams();
        $content_byIds = $this->Teams->AssocTeamsCriterions->getContentByIdTeam($id);
        $percent_byIds = $this->Teams->AssocTeamsCriterions->getPercentByIdTeam($id);
        //$users = $this->Teams->Users->find('list');

        $pageName = $this->pageName;
        $this->set(compact('team', 'departements', 'files', 'criterions', 'content_byIds', 'percent_byIds', 'pageName', 'users', 'projects'));
        $this->set('_serialize', ['team']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Team id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $team = $this->Teams->get($id);
        if ($this->Teams->delete($team)) {
            $path_file = $this->dir.DS.$team->path_image;
            if(file_exists($path_file)){
                //effacer tous les fichiers
                array_map('unlink', glob("$path_file/*.*"));
                //effacer le dossier
                rmdir($path_file);
            }
            $this->Flash->success(__('has been deleted.', ['L\'', __('team'), 'e']));
        } else {
            $this->Flash->error(__('could not be deleted. Please, try again.', ['L\'', __('team'), 'e']));
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
}
