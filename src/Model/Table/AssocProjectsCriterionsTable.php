<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\ORM\TableRegistry;

/**
 * AssocProjectsCriterions Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Projects
 * @property \Cake\ORM\Association\BelongsTo $Criterions
 *
 * @method \App\Model\Entity\AssocProjectsCriterion get($primaryKey, $options = [])
 * @method \App\Model\Entity\AssocProjectsCriterion newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\AssocProjectsCriterion[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\AssocProjectsCriterion|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\AssocProjectsCriterion patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\AssocProjectsCriterion[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\AssocProjectsCriterion findOrCreate($search, callable $callback = null)
 */
class AssocProjectsCriterionsTable extends Table
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

        $this->table('assoc_projects_criterions');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('Projects', [
            'foreignKey' => 'project_id',
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
        $rules->add($rules->existsIn(['project_id'], 'Projects'));
        $rules->add($rules->existsIn(['criterion_id'], 'Criterions'));

        return $rules;
    }
    
    public function getAssocIdByCriterionAndProject($criterion_id, $project_id) {
        $assoc = TableRegistry::get('AssocProjectsCriterions');
        $result = $assoc->find()->select(['id'])->where(['project_id' => $project_id, 'criterion_id' => $criterion_id])->first();
        return $result['id'];
    }
    
    public function update_content($id, $content) {
        $assoc = TableRegistry::get('AssocProjectsCriterions');
        $query = $assoc->query();
        $query->update()
                ->set(['content' => $content])
                ->where(['id' => $id])
                ->execute();
    }
    
    public function update_percent($id, $percent) {
        $assoc = TableRegistry::get('AssocProjectsCriterions');
        $query = $assoc->query();
        $query->update()
                ->set(['percent' => $percent])
                ->where(['id' => $id])
                ->execute();
    }
    
    public function getContentByIdProject($id) {
        $assoc = TableRegistry::get('AssocProjectsCriterions');
        $result = $assoc->find('list', ['keyField' => 'criterion_id', 'valueField' => 'content'])->where(['project_id' => $id])->toArray();
        return $result;
    }
    
    public function getPercentByIdProject($id) {
        $assoc = TableRegistry::get('AssocProjectsCriterions');
        $result = $assoc->find('list', ['keyField' => 'criterion_id', 'valueField' => 'percent'])->where(['project_id' => $id])->toArray();
        return $result;
    }
}
