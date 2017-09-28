<?php
namespace App\Controller;

use App\Controller\AppController;

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
