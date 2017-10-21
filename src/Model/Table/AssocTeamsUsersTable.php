<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\ORM\TableRegistry;

/**
 * AssocTeamsUsers Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Teams
 * @property \Cake\ORM\Association\BelongsTo $Users
 *
 * @method \App\Model\Entity\AssocTeamsUser get($primaryKey, $options = [])
 * @method \App\Model\Entity\AssocTeamsUser newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\AssocTeamsUser[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\AssocTeamsUser|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\AssocTeamsUser patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\AssocTeamsUser[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\AssocTeamsUser findOrCreate($search, callable $callback = null)
 */
class AssocTeamsUsersTable extends Table
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

        $this->table('assoc_teams_users');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('Teams', [
            'foreignKey' => 'team_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
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
        $rules->add($rules->existsIn(['user_id'], 'Users'));
        $rules->add($rules->isUnique(
            ['user_id', 'team_id'],
            'This user & team combination has already been used.'
        ));
        return $rules;
    }


    public function getUsersByTeams(){ //returner les id des teams et leurs employées
        $assocs = TableRegistry::get('AssocTeamsUsers');
        //$results = $teams->find('all')->contain(['Users'])->toArray();
        $results = $assocs->find('all')->where(['accessLevel >' => 1])->toArray();
        return $this->usersbyteams_order($results);
    }
    public function getIdsUsersByTeamId($team_id) {
        $assoc = TableRegistry::get('AssocTeamsUsers');
        $result = $assoc->find('list', ['keyField' => 'id', 'valueField' => 'user_id'])->where(['team_id' => $team_id, 'accessLevel >' => 1])->toArray();
        return $result;
    }
    function usersbyteams_order($assoc_t_u) {
        $assoc_order = array();
        foreach ($assoc_t_u as $key => $assoc) {
            $team_id = $assoc->team_id;
            $assoc_order[$team_id][] = $assoc->user_id;
        }
        return $assoc_order;
    }
}
