<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\ORM\TableRegistry;

/**
 * Authentifications Model
 *
 * @method \App\Model\Entity\Authentification get($primaryKey, $options = [])
 * @method \App\Model\Entity\Authentification newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Authentification[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Authentification|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Authentification patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Authentification[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Authentification findOrCreate($search, callable $callback = null)
 */
class AuthentificationsTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->table('authentifications');
        $this->displayField('id');
        $this->primaryKey('id');   
        
        $this->hasOne('Users', [
            'className' => 'Users'
        ]);
        
        $this->hasOne('Clients', [
            'className' => 'Clients'
        ]);
        
        $this->hasOne('Members', [
            'className' => 'Members'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->allowEmpty('type');

        $validator
            ->email('email')
            ->allowEmpty('email')
            ->add('email', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);
        
        $validator
            ->allowEmpty('client_id');
        
        $validator
            ->allowEmpty('user_id');

        $validator
            ->allowEmpty('password');
        
        $validator
            ->integer('group_manager')
            ->allowEmpty('group_manager');

        $validator
            ->integer('criterions_manager')
            ->allowEmpty('criterions_manager');
        $validator
            ->integer('priorities_manager')
            ->allowEmpty('priorities_manager');
        $validator
            ->integer('stages_manager')
            ->allowEmpty('stages_manager');
        $validator
            ->integer('clients_manager')
            ->allowEmpty('clients_manager');
        
        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->isUnique(['email']));

        return $rules;
    }
    
    public function getAuthIdByRelatedIdAndType($related_id, $type) {
        if($type == 'client'){
            $field = 'client_id';
        }elseif($type == 'user'){
            $field = 'user_id';
        }elseif($type == 'member'){
            $field = 'member_id';
        }else{
            return false;
        }
        $authentificationsTable = TableRegistry::get('Authentifications');
        $result = $authentificationsTable->find()->select(['id'])->where([$field => $related_id, 'type' => $type])->first();
        //debug($result); die();
        return $result['id'];
    }
    
    public function addProfile($id, $email, $password, $type, $criterions = 0, $priorities = 0, $stages = 0, $clients = 0) {
        $authentificationsTable = TableRegistry::get('Authentifications');
        $authentification = $authentificationsTable->newEntity();
        $authentification->email = $email;
        $authentification->password = $password;
        $authentification->type = $type;
        $authentification->criterions_manager = $criterions;
        $authentification->priorities_manager = $priorities;
        $authentification->stages_manager = $stages;
        $authentification->clients_manager = $clients;
        if($type == 'client'){
            $authentification->client_id = $id;
        }elseif($type == 'user'){
            $authentification->user_id = $id;
        }elseif($type == 'member'){
            $authentification->member_id = $id;
        }
        
        if ($authentificationsTable->save($authentification)) {
            $id = $authentification->id;
            return $id;
        }
        return null;
    }
    
    public function checkIfEmailValid($email, $id = null, $type = null) {
        $authentificationsTable = TableRegistry::get('Authentifications');
        $exist = $authentificationsTable->exists(['email' => $email]);
        if(($exist)&&(isset($id))&&(isset($type))){
            $results = $authentificationsTable->find()->select(['id', 'email'])->where(['email' => $email]);
            $number = $results->count();
            if($number == 1){ // Si on a un seul email ds BD
                $result = $results->first();
                if($result['id'] == $id){ // Si c'est l'email de this user/client
                    return true;
                }else{ // Si c'est l'email d'un autre user/client
                    return false;
                }
            }
        }
        return $exist;
    }
    
    public function updateAccessRights($id, $criterions = 0, $priorities = 0, $stages = 0, $clients = 0) {
        $authentificationsTable = TableRegistry::get('Authentifications');
        $authentification = $authentificationsTable->get($id);
        $authentification->criterions_manager = $criterions;
        $authentification->priorities_manager = $priorities;
        $authentification->stages_manager = $stages;
        $authentification->clients_manager = $clients;
        if($authentificationsTable->save($authentification)) {
            return true;
        }else{
            return false;
        }
    }
    
    public function updatePassword($id, $password) {
        $authentificationsTable = TableRegistry::get('Authentifications');
        $authentification = $authentificationsTable->get($id);
        $authentification->password = $password;
        if ($authentificationsTable->save($authentification)) {
            return true;
        }else{
            return false;
        }
    }
    
    public function updateEmail($id, $email) {
        $authentificationsTable = TableRegistry::get('Authentifications');
        $authentification = $authentificationsTable->get($id);
        $authentification->email = $email;
        if ($authentificationsTable->save($authentification)) {
            return true;
        }else{
            return false;
        }
    }
    
    public function getClientsManager($id) {
        $authentificationsTable = TableRegistry::get('Authentifications');
        $authentification = $authentificationsTable->get($id);
        return $authentification->clients_manager;
    }
    
    public function getPrioritiesManager($id) {
        $authentificationsTable = TableRegistry::get('Authentifications');
        $authentification = $authentificationsTable->get($id);
        return $authentification->priorities_manager;
    }
    
    public function getStagesManager($id) {
        $authentificationsTable = TableRegistry::get('Authentifications');
        $authentification = $authentificationsTable->get($id);
        return $authentification->priorities_manager;
    }
    
    public function getCriterionsManager($id) {
        $authentificationsTable = TableRegistry::get('Authentifications');
        $authentification = $authentificationsTable->get($id);
        return $authentification->priorities_manager;
    }
}
