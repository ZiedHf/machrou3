<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\ORM\TableRegistry;

/**
 * AssocMembersProjects Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Members
 * @property \Cake\ORM\Association\BelongsTo $Projects
 *
 * @method \App\Model\Entity\AssocMembersProject get($primaryKey, $options = [])
 * @method \App\Model\Entity\AssocMembersProject newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\AssocMembersProject[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\AssocMembersProject|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\AssocMembersProject patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\AssocMembersProject[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\AssocMembersProject findOrCreate($search, callable $callback = null)
 */
class AssocMembersProjectsTable extends Table
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

        $this->table('assoc_members_projects');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('Members', [
            'foreignKey' => 'member_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Projects', [
            'foreignKey' => 'project_id',
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
            ->integer('projectManager')
            ->allowEmpty('projectManager');

        $validator
            ->integer('accessLevel')
            ->allowEmpty('accessLevel');

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
        $rules->add($rules->existsIn(['member_id'], 'Members'));
        $rules->add($rules->existsIn(['project_id'], 'Projects'));
        $rules->add($rules->isUnique(
            ['member_id', 'project_id'],
            'This user & project combination has already been used.'
        ));
        return $rules;
    }
    /*
    public function getIdsprojectByMemberId($user_id) {
        $assoc = TableRegistry::get('AssocMembersProjects');
        $result = $assoc->find('list', ['keyField' => 'id', 'valueField' => 'project_id'])->where(['member_id' => $user_id, 'accessLevel >' => 0])->toArray();
        return $result;
    }*/
}
