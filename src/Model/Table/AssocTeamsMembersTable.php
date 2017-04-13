<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * AssocTeamsMembers Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Teams
 * @property \Cake\ORM\Association\BelongsTo $Members
 *
 * @method \App\Model\Entity\AssocTeamsMember get($primaryKey, $options = [])
 * @method \App\Model\Entity\AssocTeamsMember newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\AssocTeamsMember[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\AssocTeamsMember|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\AssocTeamsMember patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\AssocTeamsMember[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\AssocTeamsMember findOrCreate($search, callable $callback = null)
 */
class AssocTeamsMembersTable extends Table
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

        $this->table('assoc_teams_members');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('Teams', [
            'foreignKey' => 'team_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Members', [
            'foreignKey' => 'member_id',
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
            ->integer('accessLevel')
            ->allowEmpty('accessLevel');

        $validator
            ->integer('teamManager')
            ->allowEmpty('teamManager');

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
        $rules->add($rules->existsIn(['team_id'], 'Teams'));
        $rules->add($rules->existsIn(['member_id'], 'Members'));
        $rules->add($rules->isUnique(
            ['member_id', 'team_id'],
            'This user & team combination has already been used.'
        ));
        return $rules;
    }
}
