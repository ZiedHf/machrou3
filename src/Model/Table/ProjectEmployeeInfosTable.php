<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\ORM\TableRegistry;
/**
 * ProjectEmployeeInfos Model
 *
 * @property \Cake\ORM\Association\BelongsTo $AssocUsersProjects
 *
 * @method \App\Model\Entity\ProjectEmployeeInfo get($primaryKey, $options = [])
 * @method \App\Model\Entity\ProjectEmployeeInfo newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\ProjectEmployeeInfo[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ProjectEmployeeInfo|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ProjectEmployeeInfo patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ProjectEmployeeInfo[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\ProjectEmployeeInfo findOrCreate($search, callable $callback = null)
 */
class ProjectEmployeeInfosTable extends Table
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

        $this->table('project_employee_infos');
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

        $validator
            ->integer('time_dedicated')
            ->allowEmpty('time_dedicated');

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
    
    public function insertinfo($assoc_id, $time) {
        $infos = TableRegistry::get('ProjectEmployeeInfos');
        $query = $infos->query();
        $query->insert(['assoc_users_project_id', 'time_dedicated'])
            ->values([
                'assoc_users_project_id' => $assoc_id,
                'time_dedicated' => $time
            ])
            ->execute();
    }
}
