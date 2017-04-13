<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\ORM\TableRegistry;
/**
 * Priorities Model
 *
 * @property \Cake\ORM\Association\HasMany $Projects
 *
 * @method \App\Model\Entity\Priority get($primaryKey, $options = [])
 * @method \App\Model\Entity\Priority newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Priority[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Priority|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Priority patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Priority[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Priority findOrCreate($search, callable $callback = null)
 */
class PrioritiesTable extends Table
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

        $this->table('priorities');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->hasMany('Projects', [
            'foreignKey' => 'priority_id'
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
            ->integer('order_priority')
            ->requirePresence('order_priority', 'create')
            ->notEmpty('order_priority');

        return $validator;
    }
    
    public function getPrioritiesListByOrder(){
        $priorities = TableRegistry::get('Priorities');
        $results = $priorities->find('list', ['order' => ['order_priority' => 'ASC']]);
        return $results;
    }
}
