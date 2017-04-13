<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\ORM\TableRegistry;

/**
 * AssocUsersProjects Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Users
 * @property \Cake\ORM\Association\BelongsTo $Projects
 *
 * @method \App\Model\Entity\AssocUsersProject get($primaryKey, $options = [])
 * @method \App\Model\Entity\AssocUsersProject newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\AssocUsersProject[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\AssocUsersProject|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\AssocUsersProject patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\AssocUsersProject[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\AssocUsersProject findOrCreate($search, callable $callback = null)
 */
class AssocUsersProjectsTable extends Table
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

        $this->table('assoc_users_projects');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
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
        $rules->add($rules->existsIn(['user_id'], 'Users'));
        $rules->add($rules->existsIn(['project_id'], 'Projects'));
        $rules->add($rules->isUnique(
            ['user_id', 'project_id'],
            'This user & project combination has already been used.'
        ));
        return $rules;
    }
    
    public function getAssocIdByUserAndProject($user_id, $project_id) {
        $assoc = TableRegistry::get('AssocUsersProjects');
        $result = $assoc->find()->select(['id'])->where(['project_id' => $project_id, 'user_id' => $user_id])->first();
        return $result['id'];
    }
    
    public function getIdsUsersByprojectId($project_id) {
        $assoc = TableRegistry::get('AssocUsersProjects');
        $result = $assoc->find('list', ['keyField' => 'id', 'valueField' => 'user_id'])->where(['project_id' => $project_id, 'accessLevel >' => 1])->toArray();
        return $result;
    }
    
    public function getIdsprojectByUserId($user_id) {
        $assoc = TableRegistry::get('AssocUsersProjects');
        $result = $assoc->find('list', ['keyField' => 'id', 'valueField' => 'project_id'])->where(['user_id' => $user_id, 'accessLevel >' => 1])->toArray();
        return $result;
    }
    
    public function update_timededicated($id, $time) {
        $assoc = TableRegistry::get('AssocUsersProjects');
        $query = $assoc->query();
        $query->update()
                ->set(['time_dedicated' => $time])
                ->where(['id' => $id])
                ->execute();
    }
    
    public function update_projectManager($id, $var, $project_id = null) {
        $assoc = TableRegistry::get('AssocUsersProjects');
        $query = $assoc->query();
        /*if($project_id !== null){ // Dans le cas de la modification faut reinitialiser tout les employés à 0 puis mettre le projectmanger
            $query->update()
                ->set(['projectManager' => 0])
                ->where(['project_id' => $project_id])
                ->execute();
        }
        unset($query);*/
        //if($id !== null){
        if($var == 0){
            $accessLevel = 3;
        }else{
            $accessLevel = 5;
        }
            $query = $assoc->query();
            $query->update()
                    ->set(['accessLevel' => $accessLevel])
                    ->where(['id' => $id])
                    ->execute();
        //}
    }
    
    public function update_projectManagerSetNull($project_id) {
        $assoc = TableRegistry::get('AssocUsersProjects');
        $query = $assoc->query();
        $query->update()
            ->set(['accessLevel' => 3])
            ->where(['project_id' => $project_id])
            ->execute();
    }
    
    public function getTimesDedicatedByIdProjects($id) {
        $assoc = TableRegistry::get('AssocUsersProjects');
        $result = $assoc->find('list', ['keyField' => 'user_id', 'valueField' => 'time_dedicated'])->where(['project_id' => $id])->toArray();
        return $result;
    }
    
    public function getProjectManagerByIdProject($id) {
        $assoc = TableRegistry::get('AssocUsersProjects');
        $result = $assoc->find('all')->select('user_id')->where(['project_id' => $id, 'accessLevel' => 5])->first();
        return (!empty($result)) ? $result->user_id : null;
    }
}
