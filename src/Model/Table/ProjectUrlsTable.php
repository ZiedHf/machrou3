<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\ORM\TableRegistry;
/**
 * ProjectUrls Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Projects
 *
 * @method \App\Model\Entity\ProjectUrl get($primaryKey, $options = [])
 * @method \App\Model\Entity\ProjectUrl newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\ProjectUrl[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ProjectUrl|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ProjectUrl patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ProjectUrl[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\ProjectUrl findOrCreate($search, callable $callback = null)
 */
class ProjectUrlsTable extends Table
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

        $this->table('project_urls');
        $this->displayField('name');
        $this->primaryKey('id');

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
            ->requirePresence('name', 'create')
            ->notEmpty('name');

        $validator
            ->requirePresence('url', 'create')
            ->notEmpty('url');

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

        return $rules;
    }
    
    public function getIdProject_byidUrl($projectUrl_id) {
        $projectUrlTables = TableRegistry::get('ProjectUrls');
        $result = $projectUrlTables->find()->select('Projects.id')->hydrate(false)->contain(['Projects'])->where(['ProjectUrls.id' => $projectUrl_id])->first();
        return $result['Projects']['id'];
    }
}
