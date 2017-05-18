<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Datasource\ConnectionManager;

/**
 * Members Controller
 *
 * @property \App\Model\Table\MembersTable $Members
 */
class MembersController extends AppController
{

    public function initialize() {
        parent::initialize();
        $this->pageName = 'Members';
    }
    
    public function isAuthorized($user = null){
        if(parent::isAuthorized($user)){
            return true;
        }
        
        if((isset($user['type']))&&($user['type'] === 'user')){
            /*if(in_array($this->request->action, ['index'])){
                return true;
            }*/
            //Autorisation pour les membres
        }elseif((isset($user['type']))&&($user['type'] === 'member')){ 
            if(in_array($this->request->action, ['index'])) {
                return true;
            }
            
            if(in_array($this->request->action, ['view', 'edit'])) {
                $member_id = $this->request->params['pass'][0];
                if($user['member_id'] == $member_id){
                    return true;
                }
            }
            
            if($this->request->action === 'editAccessRights'){
                $member_id = $this->request->params['pass'][0];
                if($user['member_id'] == $member_id){
                    if ($this->request->is(['patch', 'post', 'put'])) {//Si l'utilisateur essaye de modifier ses accès ça va retourner false
                        return false;
                    }
                    return true; // Sinon il peut consulter ses droits
                }
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
        $this->paginate = [
            'contain' => ['Authentifications'],
            'maxLimit' => 15,
            'order' => [
                'Members.name' => 'asc'
            ],
            'sortWhitelist' => ['Members.name', 'Members.lastName', 'Authentifications.email']
        ];
        
        //select all except the superadmin
        $members = $this->paginate($this->Members->find()->where(['Members.id !=' => '1']));
        $pageName = $this->pageName;
        $this->set(compact('members', 'pageName'));
        $this->set('_serialize', ['members']);
    }

    /**
     * View method
     *
     * @param string|null $id Member id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $member = $this->Members->get($id, [
            'contain' => ['Authentifications']
        ]);
        //debug($member);die();
        $pageName = $this->pageName;
        $this->set(compact('member', 'pageName'));
        $this->set('_serialize', ['member']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $member = $this->Members->newEntity();
        if ($this->request->is('post')) {
            $member = $this->Members->patchEntity($member, $this->request->data);
            $conn = ConnectionManager::get('default');
            $conn->begin();
            if ((!$this->Members->Authentifications->checkIfEmailValid($this->request->data['email']))&&($result = $this->Members->save($member))){
                try {
                    //enregistrer le mot de passe et l'email
                    if(!empty($this->request->data['email'])){
                        $password = (!empty($this->request->data['password'])) ? $this->request->data['password'] : null;
                        $auth_id = $this->Members->Authentifications->addProfile($result->id, $this->request->data['email'], $password, 'member', $this->request->data['criterions_rights'], $this->request->data['priorities_rights'], $this->request->data['stages_rights'], $this->request->data['clients_rights']);
                    }
                    $this->Flash->success(__('The member has been saved.'));
                    $conn->commit();
                } catch (\Exception $ex) {
                    $conn->rollback();
                    $this->Flash->error(__('The member could not be saved. Please, try again.'));
                }
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The member could not be saved. Please, try again.'));
            }
        }
        $pageName = $this->pageName;
        $this->set(compact('member', 'pageName'));
        $this->set('_serialize', ['member']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Member id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $member = $this->Members->get($id, [
            'contain' => ['Authentifications']
        ]);
        
        if ($this->request->is(['patch', 'post', 'put'])) {
            if($member->authentification->password == $this->request->data['password']){
                unset($this->request->data['password']);
            }
            //$email = (!empty($this->request->data['email'])) ? $this->request->data['email'] : null;
            $member = $this->Members->patchEntity($member, $this->request->data);
            if ($result = $this->Members->save($member, ['associated' => ['Authentifications']])) {
                $this->Flash->success(__('The member has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The member could not be saved. Please, try again.'));
            }
        }
        $pageName = $this->pageName;
        $this->set(compact('member', 'pageName'));
        $this->set('_serialize', ['member']);
    }

    public function editAccessRights($id) {
        $member = $this->Members->get($id, [
            'contain' => ['Authentifications']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $member = $this->Members->patchEntity($member, $this->request->data);
            
            $conn = ConnectionManager::get('default');
            $conn->begin();
            if(($member->authentification->group_manager == $this->request->data['authentification']['group_manager'])&&($member->authentification->member_id != 1)){
                $this->request->data['authentification']['group_manager'] = $member->authentification->group_manager;
                $this->Flash->error(__('Only the superadmin can modify the group manager.'));
            }
            if (($member->id != 1)&&($result = $this->Members->save($member, ['associated' => ['Authentifications']]))) {
                try {
                    $this->Flash->success(__('has been saved.', ['Le ', __('member'), '']));
                    $conn->commit();
                    return $this->redirect(['action' => 'view', $id]);
                } catch (\Exception $e) {
                    $conn->rollback();
                    $this->Flash->error(__('could not be saved. Please, try again.', ['Le ', __('member'), '']));
                }
            } else {
                $this->Flash->error(__('could not be saved. Please, try again.', ['Le ', __('member'), '']));
            }
        }
        $pageName = $this->pageName;
        //$type = $this->type_user;
        $this->set(compact('member', 'pageName'));
    }
    /**
     * Delete method
     *
     * @param string|null $id Member id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $member = $this->Members->get($id);
        if (($member->id != 1)&&($this->Members->delete($member))) {
            $this->Flash->success(__('The member has been deleted.'));
        } else {
            $this->Flash->error(__('The member could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
