<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\ORM\TableRegistry;

/**
 * AssocTeamsCriterions Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Teams
 * @property \Cake\ORM\Association\BelongsTo $Criterions
 *
 * @method \App\Model\Entity\AssocTeamsCriterion get($primaryKey, $options = [])
 * @method \App\Model\Entity\AssocTeamsCriterion newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\AssocTeamsCriterion[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\AssocTeamsCriterion|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\AssocTeamsCriterion patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\AssocTeamsCriterion[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\AssocTeamsCriterion findOrCreate($search, callable $callback = null)
 */
class AssocTeamsCriterionsTable extends Table
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

        $this->table('assoc_teams_criterions');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('Teams', [
            'foreignKey' => 'team_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Criterions', [
            'foreignKey' => 'criterion_id',
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
            ->allowEmpty('content');

        $validator
            ->integer('percent')
            ->allowEmpty('percent');

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
        $rules->add($rules->existsIn(['criterion_id'], 'Criterions'));

        return $rules;
    }
    
    public function getAssocIdByCriterionAndTeam($criterion_id, $team_id) {
        $assoc = TableRegistry::get('AssocTeamsCriterions');
        $result = $assoc->find()->select(['id'])->where(['team_id' => $team_id, 'criterion_id' => $criterion_id])->first();
        return $result['id'];
    }
    
    public function update_content($id, $content) {
        $assoc = TableRegistry::get('AssocTeamsCriterions');
        $query = $assoc->query();
        $query->update()
                ->set(['content' => $content])
                ->where(['id' => $id])
                ->execute();
    }
    
    public function update_percent($id, $percent) {
        $assoc = TableRegistry::get('AssocTeamsCriterions');
        $query = $assoc->query();
        $query->update()
                ->set(['percent' => $percent])
                ->where(['id' => $id])
                ->execute();
    }
    
    public function getContentByIdTeam($id) {
        $assoc = TableRegistry::get('AssocTeamsCriterions');
        $result = $assoc->find('list', ['keyField' => 'criterion_id', 'valueField' => 'content'])->where(['team_id' => $id])->toArray();
        return $result;
    }
    
    public function getPercentByIdTeam($id) {
        $assoc = TableRegistry::get('AssocTeamsCriterions');
        $result = $assoc->find('list', ['keyField' => 'criterion_id', 'valueField' => 'percent'])->where(['team_id' => $id])->toArray();
        return $result;
    }
}
