<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Actiondisciplinaires Model
 *
 * @method \App\Model\Entity\Actiondisciplinaire get($primaryKey, $options = [])
 * @method \App\Model\Entity\Actiondisciplinaire newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Actiondisciplinaire[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Actiondisciplinaire|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Actiondisciplinaire patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Actiondisciplinaire[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Actiondisciplinaire findOrCreate($search, callable $callback = null)
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ActiondisciplinairesTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config){
        parent::initialize($config);

        $this->table('actiondisciplinaires');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->belongsToMany('Users', [
            'joinTable' => 'assoc_users_actiondisciplinaires',
        ]);
        
        $this->addBehavior('Timestamp');
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
            ->allowEmpty('description');

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
}
