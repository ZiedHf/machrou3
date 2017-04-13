<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\ORM\TableRegistry;
use Cake\Datasource\ConnectionManager;
/**
 * Criterions Model
 *
 * @property \Cake\ORM\Association\HasMany $AssocProjectsCriterions
 *
 * @method \App\Model\Entity\Criterion get($primaryKey, $options = [])
 * @method \App\Model\Entity\Criterion newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Criterion[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Criterion|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Criterion patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Criterion[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Criterion findOrCreate($search, callable $callback = null)
 */
class CriterionsTable extends Table
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

        $this->table('criterions');
        $this->displayField('name');
        $this->primaryKey('id');
        
        $this->belongsToMany('Projects', [
            'joinTable' => 'assoc_projects_criterions',
        ]);
        
        $this->belongsToMany('Users', [
            'foreignKey' => 'criterion_id',
            'targetForeignKey' => 'user_id',
            'joinTable' => 'assoc_users_criterions',
            'through' => 'AssocUsersCriterions'
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
            ->requirePresence('type', 'create')
            ->notEmpty('type');

        return $validator;
    }
    
    public function getCriterionsOfProducts() {
        $criterions = TableRegistry::get('Criterions');
        $results = $criterions->find('list')->where(['type' => 'Projects']);
        return $results;
    }
    
    public function getCriterionsOfEmployee() {
        $criterions = TableRegistry::get('Criterions');
        $results = $criterions->find('list')->where(['type' => 'Employees']);
        return $results;
    }
    
    public function getCriterionsOfTeams() {
        $criterions = TableRegistry::get('Criterions');
        $results = $criterions->find('list')->where(['type' => 'Teams']);
        return $results;
    }
    
    public function getCriterionsOfDepartements() {
        $criterions = TableRegistry::get('Criterions');
        $results = $criterions->find('list')->where(['type' => 'Departements']);
        return $results;
    }
    
}
