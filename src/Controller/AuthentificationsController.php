<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\Event\Event;
/**
 * Authentifications Controller
 *
 * @property \App\Model\Table\AuthentificationsTable $Authentifications
 */
class AuthentificationsController extends AppController
{
    public function initialize() {
        parent::initialize();
    }

    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->Auth->allow(['login', 'logout']);
        //debug($this->request->params);
        if (($this->Auth->user()) && ($this->request->params['action'] == 'login')) {
            return $this->redirect($this->Auth->redirectUrl());
        }
    }

    public function isAuthorized($user = null){
        $parentValue = parent::isAuthorized($user);
        //debug($user['Auth']['User']); die();
        if($parentValue) return true;

        return false;
    }

    public function login()
    {
        $this->viewBuilder()->layout('login');
        if ($this->request->is('post')) {
            $user = $this->Auth->identify();
            if ($user) {
                $this->Auth->setUser($user);
                //$this->Auth->redirectUrl();
                $this->loadModel('Users');
                $this->loadModel('Members');
                if(isset($user['user_id'])){
                    $userdata = $this->Users->getUserDataById($user['user_id']);
                }elseif(isset($user['member_id'])){
                    $userdata = $this->Members->getMemberDataById($user['member_id']);
                }
                $name = (isset($userdata)) ? $userdata->name.' '.$userdata->lastName : __('Unknown');
                $this->request->session()->write('Auth.User.name', ucwords($name));

                return $this->redirect($this->Auth->redirectUrl());
            }
            $this->Flash->materializeWarning(__('Invalid email or password, try again'));
            //$this->redirect(['controller' => 'Authentifications', 'action' => 'login']);
        }
    }
    /**
     *
     * @return type
     */
    public function logout()
    {
        return $this->redirect($this->Auth->logout());
        //return $this->redirect(['controller' => 'Authentifications', 'action' => 'login']);
    }
}
