<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\ORM\TableRegistry;

/**
 * ProjectStages Model
 *
 * @property \Cake\ORM\Association\HasMany $Projects
 *
 * @method \App\Model\Entity\ProjectStage get($primaryKey, $options = [])
 * @method \App\Model\Entity\ProjectStage newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\ProjectStage[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ProjectStage|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ProjectStage patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ProjectStage[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\ProjectStage findOrCreate($search, callable $callback = null)
 */
class ProjectStagesTable extends Table
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

        $this->table('project_stages');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->hasMany('Projects', [
            'foreignKey' => 'project_stage_id'
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
            ->integer('order_stage')
            ->requirePresence('order_stage', 'create')
            ->notEmpty('order_stage');

        return $validator;
    }
    
    public function getStagesListByOrder(){
        $stages = TableRegistry::get('ProjectStages');
        $results = $stages->find('list', ['order' => ['order_stage' => 'ASC']]);
        return $results;
    }
    
    public function getStagesNamesStringListByOrder(){
        $stages = TableRegistry::get('ProjectStages');
        $results = $stages->find('list', ['order' => ['order_stage' => 'ASC']]);
        foreach ($results as $key => $stage) {
            $stages_list[] = $stage;
        }
        return $results;
    }
    
    public function getAllstages(){
        $stages = TableRegistry::get('ProjectStages');
        $results = $stages->find('all')->contain(['Projects'])->toArray();
        return $results;
    }
    
    public function getCountProjectsByStages($morethan){
        $stages = TableRegistry::get('ProjectStages');
        $results = $stages->find();
        $results->select(['ProjectStages.id', 'ProjectStages.name', 'total_projects' => $results->func()->count('Projects.id')])
                ->leftJoinWith('Projects')
                ->group(['ProjectStages.id'])
                ->having(['total_projects >' => $morethan])
                ->order(['order_stage' => 'ASC']);
        $results = $results->toArray();
        
        return $results;
    }
    public function getCountProjectsByStagesByUser($morethan, $user_type, $user_id, $group_manager){
        if($group_manager){
            return $this->getCountProjectsByStages($morethan);
        }
        $entity = ($user_type == 'user') ? 'Users' : 'Members';
        
        $stages = TableRegistry::get('ProjectStages');
        $projectsTable = TableRegistry::get('Projects');
        $projectsOfThisUser = $projectsTable->getAllProjects_ByUser($user_type, $user_id, $group_manager);
        $projects_ids = array();
        if($projectsOfThisUser->count() > 0){
            foreach ($projectsOfThisUser as $key => $project) {
            $projects_ids[] =  $project->id;
         }
        }
        
        $results = $stages->find();
        $results->select(['ProjectStages.id', 'ProjectStages.name', 'total_projects' => $results->func()->count('Projects.id')])
                ->leftJoinWith('Projects', function ($q) use ($projects_ids) {
                                        return $q->where(["Projects.id IN" => $projects_ids]);
                                    })
                ->group(['ProjectStages.id'])
                ->having(['total_projects >' => $morethan])
                ->order(['order_stage' => 'ASC']);
                                    
        //debug();die();
        $results = $results->toArray();
        
        return $results;
    }
}
