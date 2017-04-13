<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\ORM\TableRegistry;

/**
 * AssocUsersCriterions Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Users
 * @property \Cake\ORM\Association\BelongsTo $Criterions
 *
 * @method \App\Model\Entity\AssocUsersCriterion get($primaryKey, $options = [])
 * @method \App\Model\Entity\AssocUsersCriterion newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\AssocUsersCriterion[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\AssocUsersCriterion|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\AssocUsersCriterion patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\AssocUsersCriterion[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\AssocUsersCriterion findOrCreate($search, callable $callback = null)
 */
class AssocUsersCriterionsTable extends Table
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

        $this->table('assoc_users_criterions');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
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
        $rules->add($rules->existsIn(['user_id'], 'Users'));
        $rules->add($rules->existsIn(['criterion_id'], 'Criterions'));

        return $rules;
    }
    
    public function getAssocIdByCriterionAndUser($criterion_id, $user_id) {
        $assoc = TableRegistry::get('AssocUsersCriterions');
        $result = $assoc->find()->select(['id'])->where(['user_id' => $user_id, 'criterion_id' => $criterion_id])->first();
        return $result['id'];
    }
    
    public function update_content($id, $content) {
        $assoc = TableRegistry::get('AssocUsersCriterions');
        $query = $assoc->query();
        $query->update()
                ->set(['content' => $content])
                ->where(['id' => $id])
                ->execute();
    }
    
    public function update_percent($id, $percent) {
        $assoc = TableRegistry::get('AssocUsersCriterions');
        $query = $assoc->query();
        $query->update()
                ->set(['percent' => $percent])
                ->where(['id' => $id])
                ->execute();
    }
    
    public function getContentByIdUser($id) {
        $assoc = TableRegistry::get('AssocUsersCriterions');
        $result = $assoc->find('list', ['keyField' => 'criterion_id', 'valueField' => 'content'])->where(['user_id' => $id])->toArray();
        return $result;
    }
    
    public function getPercentByIdUser($id) {
        $assoc = TableRegistry::get('AssocUsersCriterions');
        $result = $assoc->find('list', ['keyField' => 'criterion_id', 'valueField' => 'percent'])->where(['user_id' => $id])->toArray();
        return $result;
    }
}
