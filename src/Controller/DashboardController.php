<?php
namespace App\Controller;

use App\Controller\AppController;

class DashboardController extends AppController
{

    public function initialize() {
        parent::initialize();
        $this->pageName = 'Dashboard';
    }
    
    public function isAuthorized($user = null){
        //Autorisation pour le client
        if((isset($user['type']))&&($user['type'] === 'client')){ 
            return true;
        //Autorisation pour le user
        }elseif((isset($user['type']))&&($user['type'] === 'user')){
        //Autorisation pour le member
            return true;
        }elseif((isset($user['type']))&&($user['type'] === 'member')){ 
            return true;
        }
        return parent::isAuthorized($user);
    }
    
    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $pageName = $this->pageName;
        $this->set(compact('pageName'));
        //$this->viewBuilder()->layout('dashboard');
        //die('aaa');
        //$departements = $this->paginate($this->Departements);

        //$this->set(compact('departements'));
        //$this->set('_serialize', ['departements']);
    }
}

