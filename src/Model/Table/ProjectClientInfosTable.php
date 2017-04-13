<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ProjectClientInfos Model
 *
 * @property \Cake\ORM\Association\BelongsTo $AssocUsersProjects
 *
 * @method \App\Model\Entity\ProjectClientInfo get($primaryKey, $options = [])
 * @method \App\Model\Entity\ProjectClientInfo newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\ProjectClientInfo[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ProjectClientInfo|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ProjectClientInfo patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ProjectClientInfo[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\ProjectClientInfo findOrCreate($search, callable $callback = null)
 */
class ProjectClientInfosTable extends Table
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

        $this->table('project_client_infos');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('AssocUsersProjects', [
            'foreignKey' => 'assoc_users_project_id',
            'joinType' => 'INNER'
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
        $rules->add($rules->existsIn(['assoc_users_project_id'], 'AssocUsersProjects'));

        return $rules;
    }
}
