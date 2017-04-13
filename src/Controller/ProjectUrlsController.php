<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * ProjectUrls Controller
 *
 * @property \App\Model\Table\ProjectUrlsTable $ProjectUrls
 */
class ProjectUrlsController extends AppController
{

    
    public function initialize() {
        parent::initialize();
        $this->pageName = 'ProjectUrls';
        
        //$user = $this->Auth->user();
        if($this->Auth->user('type') === 'member'){
            $this->id = $this->Auth->user('member_id');
        }elseif($this->Auth->user('type') === 'user'){
            $this->id = $this->Auth->user('user_id');
        }
    }
    
    public function isAuthorized($user = null){
        if(parent::isAuthorized($user)){
            return true;
        }
        
        if((isset($user['type']))&&($user['type'] === 'user')){
            
            if(in_array($this->request->action, ['view'])) {
                
                $projectUrl_id = $this->request->params['pass'][0];
                $project_id = $this->ProjectUrls->getIdProject_byidUrl($projectUrl_id);
                /*
                 * $users_project = $this->ProjectUrls->Projects->getusers_project($project_id);
                if(in_array($user['user_id'], $users_project)){
                    return true;
                }
                */
                if($this->haveAccessRight($user, $project_id)){//Pas besoin de vérifier le projet s'il est un super admin ou un group manager
                    return true;
                }
            }
            
            if(in_array($this->request->action, ['add', 'edit'])) {
                /*if($this->haveAccessRight($user)){//Pas besoin de vérifier le projet s'il est un super admin ou un group manager
                    return true;
                }
                */
                if(isset($this->request->params['pass'][0])){//Sinon on doit vérifier par le projet et l'id user
                    //récupérer l'id du projet
                    
                    if($this->request->action === 'edit'){
                        $urlProject_id = $this->request->params['pass'][0];
                        $project_id = $this->ProjectUrls->getIdProject_byidUrl($urlProject_id);
                    }else{
                        $project_id = $this->request->params['pass'][0];
                    }
                    if ($this->request->is(['patch', 'post', 'put'])) {// Y'a un envoi d'une requete de changement
                        
                        if(isset($this->request->data['project_id'])){//L'id de projet dans le formulaire
                            $projectForChange = (int)$this->request->data['project_id'];
                            //debug($projectForChange); die();
                            if($this->haveAccessRight($user, $projectForChange)){//Test si l'utilisateur a le droit de changer
                                return true; //On cas de changement de l'id du projet par HTML
                            }
                        }else{
                            return true; //Pas de changement sur l'id (même projet)
                        }
                    }
                    if($this->haveAccessRight($user, $project_id)){//S'il est un supérieur
                        return true;
                    }
                }
            }
            
            /*if(in_array($this->request->action, ['edit'])) {
                if($this->haveAccessRight($user['user_id'])){//Pas besoin de vérifier le projet s'il est un super admin ou un group manager
                    return true;
                }
                
                if(isset($this->request->params['pass'][0])){//Sinon on doit vérifier par le projet et l'id user
                    $urlProject_id = $this->request->params['pass'][0];
                    $project_id = $this->ProjectUrls->getIdProject_byidUrl($urlProject_id);
                    if ($this->request->is(['patch', 'post', 'put'])) {// Y'a un envoi d'une requete de changement
                        if(isset($this->request->data['project_id'])){//L'id de projet dans le formulaire
                            $projectForChange = $this->request->data('project_id');
                            if($this->haveAccessRight($user['user_id'], $projectForChange)){//Test si l'utilisateur a le droit de changer
                                return true; //On cas de changement de l'id du projet par HTML
                            }
                        }else{
                            return true; //Pas de changement sur l'id (même projet)
                        }
                    }
                    if($this->haveAccessRight($user['user_id'], $project_id)){//S'il est un supérieur
                        return true;
                    }
                }
            }*/
            /*
            if($this->request->action == 'view'){
                $project_id = $this->request->params['pass'][0];
                $users_team = $this->Projects->getusers_project($project_id);
                if(in_array($user['user_id'], $users_team)){
                    return true;
                }
            }*/
            //Autorisation pour les membres
        }elseif((isset($user['type']))&&($user['type'] === 'member')){ 
            if(in_array($this->request->action, ['index'])) {
                return true;
            }
        }
        return false;
    }
    /*
    public function isTheChefProject($project_id, $user_id) {//he is the chef project
        $this->loadModel('AssocUsersProjects');
        $idChefProject = $this->AssocUsersProjects->getProjectManagerByIdProject($project_id);
        if($idChefProject == $user_id){
            return true;
        }else{
            return false;
        }
    }
    */
    public function haveAccessRight($user, $project_id = null, $action = null) {
        $projectsController = New ProjectsController;
        if($this->request->action === 'add'){
            $action = 'projecUrls/add';
        }elseif($this->request->action === 'view'){
            $action = 'projecUrls/view';
        }elseif($this->request->action === 'edit'){
            $action = 'projecUrls/edit';
        }
        $haveAccessRight = $projectsController->haveAccessRight($user, $project_id, $action);
        if($haveAccessRight){
            return true;
        }
        /*if($this->Auth->user('group_manager')){
            return true;
        }*/
        //test s'il est le manager de company
        //test s'il est le manager de departement
        //test s'il est le manager de team
        //test s'il est le manager de projet
        /*if(isset($project_id)){
            return $this->isTheChefProject($project_id, $user_id);
        }*/
        return false;
    }
    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Projects']
        ];
        $projectUrls = $this->paginate($this->ProjectUrls);

        $pageName = $this->pageName;
        $this->set(compact('projectUrls', 'pageName'));
        $this->set('_serialize', ['projectUrls']);
    }

    /**
     * View method
     *
     * @param string|null $id Project Url id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $projectUrl = $this->ProjectUrls->get($id, [
            'contain' => ['Projects']
        ]);
        $pageName = $this->pageName;
        $this->set(compact('pageName'));
        $this->set('projectUrl', $projectUrl);
        $this->set('_serialize', ['projectUrl']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add($project_id = null)
    {
        $projectUrl = $this->ProjectUrls->newEntity();
        if ($this->request->is('post')) {
            $projectUrl = $this->ProjectUrls->patchEntity($projectUrl, $this->request->data);
            
            if ($result = $this->ProjectUrls->save($projectUrl)) {
                $this->Flash->success(__('has been saved.', ['Le ', __('url'), '']));
                return $this->redirect(['action' => 'view', $result->id]);
            } else {
                $this->Flash->error(__('could not be saved. Please, try again.', ['Le ', __('url'), '']));
            }
        }
        $projects = $this->ProjectUrls->Projects->find('list');
        $pageName = $this->pageName;
        $this->set(compact('projectUrl', 'projects', 'pageName', 'project_id'));
        $this->set('_serialize', ['projectUrl']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Project Url id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $projectUrl = $this->ProjectUrls->get($id, [
            'contain' => []
        ]);
        $project_id = (isset($id)) ? $this->ProjectUrls->getIdProject_byidUrl($id) : null;
        if ($this->request->is(['patch', 'post', 'put'])) {
            $projectUrl = $this->ProjectUrls->patchEntity($projectUrl, $this->request->data);
            if ($this->ProjectUrls->save($projectUrl)) {
                $this->Flash->success(__('has been saved.', ['Le ', __('url'), '']));
                return $this->redirect(['action' => 'view', $id]);
            } else {
                $this->Flash->error(__('could not be saved. Please, try again.', ['Le ', __('url'), '']));
            }
        }
        $projects = $this->ProjectUrls->Projects->find('list');
        $pageName = $this->pageName;
        $this->set(compact('projectUrl', 'projects', 'pageName', 'project_id'));
        $this->set('_serialize', ['projectUrl']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Project Url id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $projectUrl = $this->ProjectUrls->get($id);
        if ($this->ProjectUrls->delete($projectUrl)) {
            $this->Flash->success(__('has been deleted.', ['Le ', __('url'), '']));
        } else {
            $this->Flash->error(__('could not be deleted. Please, try again.', ['Le ', __('url'), '']));
        }

        return $this->redirect(['action' => 'index']);
    }
}
