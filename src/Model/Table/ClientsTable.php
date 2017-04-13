<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\ORM\TableRegistry;

/**
 * Clients Model
 *
 * @property \Cake\ORM\Association\HasMany $AssocClientsProjects
 *
 * @method \App\Model\Entity\Client get($primaryKey, $options = [])
 * @method \App\Model\Entity\Client newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Client[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Client|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Client patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Client[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Client findOrCreate($search, callable $callback = null)
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ClientsTable extends Table
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

        $this->table('clients');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        /*$this->hasMany('AssocClientsProjects', [
            'foreignKey' => 'client_id'
        ]);*/
        $this->belongsToMany('Projects', [
            'joinTable' => 'assoc_clients_projects',
        ]);
        
        $this->hasOne('Authentifications', [
            'ForeignKey' => 'Client_id'
        ]);
        
        $this->addBehavior('Search.Search');
        $this->searchManager()
            ->add('q', 'Search.Like', [
                'before' => true,
                'after' => true,
                'fieldMode' => 'OR',
                'comparison' => 'LIKE',
                'wildcardAny' => '*',
                'wildcardOne' => '?',
                'field' => ['name', 'lastName', 'description']
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
            ->requirePresence('name', 'create')
            ->notEmpty('name');

        $validator
            ->allowEmpty('lastName');
        
        $validator
            ->allowEmpty('description');

        $validator
            ->allowEmpty('path_image');

        $validator
            ->integer('created_by')
            ->allowEmpty('created_by');

        $validator
            ->integer('modified_by')
            ->allowEmpty('modified_by');
        
        $validator
            ->allowEmpty('created_type');
        $validator
            ->allowEmpty('modified_type');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    /*public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->isUnique(['email']));

        return $rules;
    }*/
    
    public function getCountClients() {
        $clients = TableRegistry::get('Clients');
        $result = $clients->find('list')->count();
        return $result;
    }
    
    public function getAllClientsData() {
        $clients = TableRegistry::get('Clients');
        $result = $clients->find('all')->contain(['Authentifications', 'Projects'])->order(['name' => 'ASC'])->toArray();
        return $result;
    }
    public function getClientsList() {
        $clients = TableRegistry::get('Clients');
        $result = $clients->find('list')->order(['name' => 'ASC'])->toArray();
        return $result;
    }
    public function getAllClientDataById($id) {
        $clients = TableRegistry::get('Clients');
        $result = $clients->find('all')->contain(['Authentifications', 'Projects'])->where(['Clients.id' => $id])->first();
        return $result;
    }
}
