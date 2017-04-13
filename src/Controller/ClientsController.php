<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Datasource\ConnectionManager;
use Search\Manager;
/**
 * Clients Controller
 *
 * @property \App\Model\Table\ClientsTable $Clients
 */
class ClientsController extends AppController
{

    public function initialize(){
        parent::initialize();
        $this->pageName = 'Clients';
        //$this->dir_projects = WWW_ROOT . 'uploads' . DS . 'projects';
        $this->loadComponent('RequestHandler');
        $this->loadComponent('Search.Prg', ['actions' => ['index', 'lookup']]);
    }
    
    public function isAuthorized($user = null){
        if(parent::isAuthorized($user)){
            return true;
        }
        //Autorisation pour le client
        if((isset($user['type']))&&($user['type'] === 'client')){ 
            if(in_array($this->request->action, ['index'])) {
                return true;
            }
            
            if(($this->request->action == 'view')||($this->request->action == 'edit')){
                $client_id = $this->request->params['pass'][0];
                if($client_id == $user['client_id']){
                    return true;
                }
            }
        }elseif((isset($user['type']))&&(in_array($user['type'], ['user', 'member']))){
            //if($this->Clients->Authentifications->getClientsManager($user['id'])){
            if((isset($user['clients_manager']))&&($user['clients_manager'])){
                return true;
            }
        }
        //debug($user);die();
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
            'contain' => ['Authentifications'],
            'maxLimit' => 15
        ];
        $query = $this->Clients
        ->find('search', ['search' => $this->request->query]);
        $clients = $this->paginate($query);
        $pageName = $this->pageName;
        $this->set(compact('clients', 'pageName'));
        $this->set('_serialize', ['clients']);
        $this->set('isSearch', $this->Clients->isSearch());
    }

    /**
     * View method
     *
     * @param string|null $id Client id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $client = $this->Clients->get($id, [
            'contain' => ['Projects', 'Authentifications']
        ]);
        //debug($client);die();
        $pageName = $this->pageName;
        $this->set(compact('client', 'pageName'));
        $this->set('_serialize', ['client']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $client = $this->Clients->newEntity();
        if ($this->request->is('post')) {
            $client = $this->Clients->patchEntity($client, $this->request->data);
            $password = (!empty($this->request->data['password'])) ? $this->request->data['password'] : null;
            $email = (!empty($this->request->data['email'])) ? $this->request->data['email'] : null;
            $conn = ConnectionManager::get('default');
            $conn->begin();
            if(((!$this->Clients->Authentifications->checkIfEmailValid($email))||($email === null))&&($result = $this->Clients->save($client))){
                try {
                    if(!empty($email)){
                        $auth_id = $this->Clients->Authentifications->addProfile($result->id, $email, $password, 'client');
                    }
                    $this->Flash->success(__('has been saved.', ['Le ', 'client', '']));
                    $conn->commit();
                    return $this->redirect(['action' => 'view', $result->id]);
                } catch (\Exception $e) {
                    $conn->rollback();
                    $this->Flash->error(__('could not be saved. Please, try again.', ['Le ', 'client', '']));
                }
                
            } else {
                $this->Flash->error(__('could not be saved. Please, try again.', ['Le ', 'client', '']));
            }
        }
        $this->loadModel('Projects');
        $pageName = $this->pageName;
        $projects = $this->Projects->getProjectsList();
        $this->set(compact('client', 'projects', 'pageName'));
        $this->set('_serialize', ['client']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Client id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $client = $this->Clients->get($id, [
            'contain' => ['Authentifications']
        ]);
        
        if ($this->request->is(['patch', 'post', 'put'])) {
            $client = $this->Clients->patchEntity($client, $this->request->data);
            $password = (!empty($this->request->data['password'])) ? $this->request->data['password'] : null;
            $email = (!empty($this->request->data['email'])) ? $this->request->data['email'] : null;
            $conn = ConnectionManager::get('default');
            $conn->begin();
            if(((!$this->Clients->Authentifications->checkIfEmailValid($email, $id, 'client'))||($email === null))&&($this->Clients->save($client))){
                try {
                    $auth_id = $this->Clients->Authentifications->getAuthIdByRelatedIdAndType($id, 'client');
                    if(isset($auth_id)){
                        if(!empty($password)){
                            $ok = $this->Clients->Authentifications->updatePassword($auth_id, $password);
                        }
                        if(!empty($email)){
                            $ok = $this->Clients->Authentifications->updateEmail($auth_id, $email);
                        }
                    }else{ //si y a pas un auth_id
                        $this->Clients->Authentifications->addProfile($id, $email, $password, 'client');
                    }
                    $this->Flash->success(__('has been saved.', ['Le ', 'client', '']));
                    $conn->commit();
                    return $this->redirect(['action' => 'view', $id]);
                } catch (\Exception $e) {
                    $conn->rollback();
                    $this->Flash->error(__('could not be saved. Please, try again.', ['Le ', 'client', '']));
                }
                
                
                //$this->Flash->success(__('has been saved.', ['Le ', 'client', '']));

                //return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('could not be saved. Please, try again.', ['Le ', 'client', '']));
            }
        }
        $pageName = $this->pageName;
        $this->set(compact('client', 'pageName'));
        $this->set('_serialize', ['client']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Client id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $client = $this->Clients->get($id);
        if ($this->Clients->delete($client)) {
            $this->Flash->success(__('has been deleted.', ['Le ', 'client', '']));
        } else {
            $this->Flash->error(__('could not be deleted. Please, try again.', ['Le ', 'client', '']));
        }

        return $this->redirect(['action' => 'index']);
    }
}
