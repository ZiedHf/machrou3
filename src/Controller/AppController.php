<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link      http://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;
use Cake\Network\Response;
use Cake\Auth\DefaultPasswordHasher;
use Cake\Utility\Security;
/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link http://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{

    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('Security');`
     *
     * @return void
     */
    public function initialize()
    {
        parent::initialize();

        $this->loadComponent('RequestHandler');
        $this->loadComponent('Flash');
        $this->loadComponent('Auth', [
            'loginAction' => [
                'controller' => 'Authentifications',
                'action' => 'login'
            ],
            'authenticate' => [
                'Form' => [
                    'fields' => ['username' => 'email', 'password' => 'password'],
                    'userModel' => 'authentifications'
                ]
            ],
            'storage' => 'Session',
            'authorize' => ['Controller'],
            'authError' => 'Did you really think you are allowed to see that ?',
            'loginRedirect' => [
                'controller' => 'Consult',
                'action' => 'index'
            ],
            'logoutRedirect' => [
                'controller' => 'Authentifications',
                'action' => 'login'
            ],
            'flash' => ['element' => 'error']
        ]);
        
        $this->Auth->allow(['login', 'logout']);
    }

    public function isAuthorized($user = null)
    {
        //Permettre tous les access au superadmin
        if((isset($user['member_id']))&&($user['member_id'] == 1)){
            return true;
        }
        //ne pas permettre la suppression
        if(($this->request->action === 'delete')){
            return false;
        }
        //Tout les access au group manager
        if((isset($user['group_manager']))&&($user['group_manager'] == true)){//If the user or the member are group manager give them full access
            return true;
        }
        
        
        return false;
    }
    /**
     * Before render callback.
     *
     * @param \Cake\Event\Event $event The beforeRender event.
     * @return \Cake\Network\Response|null|void
     */
    public function beforeRender(Event $event)
    {
        if (!array_key_exists('_serialize', $this->viewVars) &&
            in_array($this->response->type(), ['application/json', 'application/xml'])
        ) {
            $this->set('_serialize', true);
        }
    }
    
    public function beforeFilter(Event $event)
    {
        //$this->set('logged_in', $this->Auth->loggedIn());
        //$this->set('current_user', $this->Auth->user());
        if (!$this->Auth->user()) {
            //$this->Auth->config('authError', false);
        }else{
            //$this->Auth->config('authError', 'test auth');
            //return $this->redirect($this->Auth->redirectUrl());
        }
    }
    
    public function slug($z){
        $z = strtolower($z);
        $z = preg_replace('/[^.a-z0-9-]+/', '', $z);
        //$z = str_replace(' ', '-', $z);
        return trim($z, '-');
    }
    
    public function isImage($file) {
        $image_ext = array('jpg', 'jpeg', 'png');
        $ext = pathinfo($file, PATHINFO_EXTENSION);
        if(in_array($ext, $image_ext)){
            return true;
        }else{
            return false;
        }
    }
    public function getImagesFiles(&$files){
        if((empty($files))) return false;
        $images = array();
        foreach ($files as $key => $file) {
            if($this->isImage($file)){
                unset($files[$key]);
                $images[] = $file;
            }
        }
        return $images;
    }
    
    public function viewPic($path_dir = null, $url = null){
        if(($path_dir == null) || ($url == null) || (! $this->isImage($url))) {
            return false;
        }
        
        $this->response->file(PROJECTS_UPLOAD.DS.$path_dir.DS.$url);
        return $this->response;
    }
    
    public function encrypt_var($var) {
        $result = Security::encrypt('Test', KEY);
        return $result;
    }
    
    public function decrypt_var($var) {
        $result = Security::decrypt($var, KEY);
        return $result;
    }
    
    //public function app_file_upload($id, $data, $field, $folderName){
    public function app_file_upload($id, $fileToUpload, $folderName){
        //upload image
        //die('ee');
        if(($id != null)&&(!empty($fileToUpload))&&($folderName != null)){
            $pathToDir = $this->dir.DS.$folderName;

            if (!file_exists($pathToDir)){
                mkdir($pathToDir, 0777, true);
            }
            //Remplacer les espaces par '_'
            //$fileToUpload = $data[$field];
            $fileToUpload['name'] = $this->slug($fileToUpload['name']);
            //Récuperation du racine et ajout d'un prefixe id pour chaque doc
            $path = $pathToDir . DS . $id . '_' .$fileToUpload['name'];
            //Upload
            if((move_uploaded_file($fileToUpload['tmp_name'], $path))){
            }else{
                $this->Flash->error(__('Doc upload : problem.'));
            }
        }
    }
    //Get Dir's Files
    public function getFilesByDir($path, $name_dir) { // Retourner les chemins des fichiers
        if(($name_dir == null)||($path == null)||(!file_exists($path.DS.$name_dir))){
            return null;
        }
        $allFiles = scandir($path.DS.$name_dir);
        $files = array_diff($allFiles, array('.', '..')); // les noms des dossiers seulement
        return $files;
    }
    
    public function setPassword($password)
    {
        return (new DefaultPasswordHasher)->hash($password);
    }
    
    public function return_array($param, $field, $field2 = null) { //Retourner un array d'un seul field d'un autre array plus compliqué
        foreach($param as $key => $value){
            if($field2 === null){
                if(isset($value[$field])){
                    $result[] = $value[$field];
                }
            }else{
                if(isset($value[$field][$field2])){
                    $result[] = $value[$field][$field2];
                }
            }
        }
        if(empty($result)){return null;}
        return array_unique($result);
    }
}
