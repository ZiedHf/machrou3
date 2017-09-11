<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\ORM\TableRegistry;
use Cake\Datasource\ConnectionManager;

/**
 * Departements Model
 *
 * @property \Cake\ORM\Association\HasMany $Teams
 *
 * @method \App\Model\Entity\Departement get($primaryKey, $options = [])
 * @method \App\Model\Entity\Departement newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Departement[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Departement|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Departement patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Departement[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Departement findOrCreate($search, callable $callback = null)
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class DepartementsTable extends Table
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

        $this->table('departements');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Companies', [
            'foreignKey' => 'company_id'
        ]);
        
        $this->hasMany('Teams', [
            'foreignKey' => 'departement_id'
        ]);
        
        $this->belongsToMany('Criterions', [
            'joinTable' => 'assoc_departements_criterions',
        ]);
        
        $this->belongsToMany('Users', [
            'joinTable' => 'assoc_departements_users',
            'through' => 'AssocDepartementsUsers'
        ]);
        $this->belongsToMany('Members', [
            'joinTable' => 'assoc_departements_members',
            'through' => 'AssocDepartementsMembers'
        ]);
        
        $this->addBehavior('Search.Search');
        $this->searchManager()
            ->add('q', 'Search.Like', [
                'before' => true,
                'after' => true,
                'fieldMode' => 'OR',
                'comparison' => 'LIKE',
                'wildcardAny' => '*',
                'wildcardOne' => '?',
                'field' => ['name', 'description']
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
            ->allowEmpty('description');

        $validator
            ->integer('created_by')
            ->allowEmpty('created_by');

        $validator
            ->integer('modified_by')
            ->allowEmpty('modified_by');
        
        $validator
            ->allowEmpty('created_type');
        $validator
            ->allowEmpty('modified_type');

        $validator
            ->integer('company_id')
            ->notEmpty('company_id', 'Please fill this field');
        
        return $validator;
    }
    
    public function getAllDepData(){
        $departements = TableRegistry::get('Departements');
        $results = $departements->find('all')->contain(['Teams', 'Criterions', 'Teams.Projects', 'Teams.Users','Teams.Projects.Users' => ['queryBuilder' => function ($q) {
                                                                                                        return $q->where(['AssocUsersProjects.accessLevel >' => '1']);
                                                                                                    }]])->order(['name' => 'ASC'])->toArray();
        //$results = $departements->find('all')->toArray();
        return $results;
    }
    
    public function getAllDepDataOfThisUser($user_type, $user_id, $group_manager){
        if($group_manager){
            return $this->getAllDepData();
        }
        
        $departements = TableRegistry::get('Departements');
        /*
        $results = $departements->find('all')->contain(['Teams', 'Criterions', 'Teams.Projects', 'Teams.Users','Teams.Projects.Users' => ['queryBuilder' => function ($q) {
                                                                                                        return $q->where(['AssocUsersProjects.accessLevel >' => '1']);
                                                                                                    }]])->order(['name' => 'ASC'])->toArray();
        */
        $entity = ($user_type == 'user') ? 'Users' : 'Members';
        
        $results_assocWithComp = $departements->find()
                        ->innerJoinWith("Companies.$entity", function ($q) use($user_id, $entity) {
                                             return $q->where(["$entity.id" => $user_id, "AssocCompanies$entity.accessLevel >" => 0]);
                                         });

         $results_assocWithDep = $departements->find()
                        ->innerJoinWith("$entity", function ($q) use($user_id, $entity) {
                                             return $q->where(["$entity.id" => $user_id, "AssocDepartements$entity.accessLevel >" => 0]);
                                         });

        $results_assocWithTeam = $departements->find()
                        ->innerJoinWith("Teams.$entity", function ($q) use($user_id, $entity) {
                                             return $q->where(["$entity.id" => $user_id, "AssocTeams$entity.accessLevel >" => 0]);
                                         });
                                         
        $results = $results_assocWithComp->union($results_assocWithDep);
        $results->union($results_assocWithTeam);
        $results = $results->epilog('ORDER BY Departements__name ASC');
        //debug($results->toArray()); die();
        $results = $results->contain(['Teams', 
                                        'Teams.Projects' => 
                                        ['queryBuilder' => function ($q) {
                                            return $q->order(['accomplishment' =>'ASC']);
                                        }], 
                                        'Teams.Projects.Priorities',
                                        'Teams.Projects.ProjectStages',
                                        'Teams.Users' => 
                                        ['queryBuilder' => function ($q) {
                                            return $q->order(['Users.name' =>'ASC']);
                                        }]
                                        ,'Teams.Projects.Users' => ['queryBuilder' => function ($q) {
                                            return $q->where(['AssocUsersProjects.accessLevel >' => '1']);
                                        }], 'Criterions']);/*->where(['Departements.id' => $id])->toArray()*/

        
        $results = $results->toArray();
        
        return $results;
    }
    
    public function getThisDepData($id){
        $departements = TableRegistry::get('Departements');
        $results = $departements->find('all')->contain(['Teams', 
                                            'Teams.Projects' => 
                                            ['queryBuilder' => function ($q) {
                                                return $q->order(['accomplishment' =>'ASC']);
                                            }], 
                                            'Teams.Projects.Priorities',
                                            'Teams.Projects.ProjectStages',
                                            'Teams.Users' => 
                                            ['queryBuilder' => function ($q) {
                                                return $q->order(['Users.name' =>'ASC']);
                                            }]
                                            ,'Teams.Projects.Users' => ['queryBuilder' => function ($q) {
                                                return $q->where(['AssocUsersProjects.accessLevel >' => '1']);
                                            }], 'Criterions'])->where(['Departements.id' => $id])->toArray();
        //$results = $departements->find('all')->toArray();
        if(isset($results[0]['id'])) {
            return $results[0];
        }
        return false;
    }
    //By Access Level
    public function getThisDepDataByUser($id, $user_type, $user_id, $group_manager){
        
        if($group_manager){
            return $this->getThisDepData($id);
        }
        
        $departements = TableRegistry::get('Departements');
        
        $entity = ($user_type == 'user') ? 'Users' : 'Members';
        
        //If this user a l'access a cette societe alors on lui donne l'access
        $results_assocWithComp = $departements->find()
                       ->innerJoinWith("Companies.$entity", function ($q) use($user_id, $entity) {
                                            return $q->where(["$entity.id" => $user_id, "AssocCompanies$entity.accessLevel >" => 0]);
                                        })->where(['Departements.id' => $id]);
        if($results_assocWithComp->count() > 0){
            return $this->getThisDepData($id);
        } 

        //If this user a l'access a ce dep alors on lui donne l'access
        $results_assocWithDep = $departements->find()
                       ->innerJoinWith("$entity", function ($q) use ($user_id, $entity) {
                                            return $q->where(["$entity.id" => $user_id, "AssocDepartements$entity.accessLevel >" => 0]);
                                        })->where(['Departements.id' => $id]);
        if($results_assocWithDep->count() > 0){
            return $this->getThisDepData($id);
        }  

        //If this user a l'access a une equipe de cette dep on affiche seulement les info de cette equipes
        $results_assocWithTeam = $departements->find()
                       ->matching("Teams.$entity", function ($q) use ($user_id, $entity) {
                                            return $q->where(["$entity.id" => $user_id, "AssocTeams$entity.accessLevel >" => 0]);
                                        })->where(['Departements.id' => $id]);
        foreach ($results_assocWithTeam as $dep) {
            $teams_ids[] = $dep->_matchingData['Teams']->id;
        }

        $projectsTable = TableRegistry::get('Projects');
        $projectsOfThisUser = $projectsTable->getAllProjectDataByUser(null, $user_type, $user_id, $group_manager);
        foreach ($projectsOfThisUser as $key => $project) {
            $project_ids[] = $project->id;
        }
        //debug($project_ids);die();
        //$results_assoc = $results_assocWithComp->union($results_assocWithDep);

        /*$results_assocWithTeam1 = $departements->find()
                       ->matching('Teams.Users', function ($q) use($user_id) {
                                            return $q->where(['Users.id' => $user_id, 'AssocTeamsUsers.accessLevel >' => 0]);
                                        })->where(['Departements.id' => $id]);

        foreach ($results_assocWithTeam1 as $key => $departement) {
                $hisTeams[] = $departement->_matchingData['Teams']->id;
        }
        */
        //$results = $results_assocWithComp->union($results_assocWithDep);
        if(empty($teams_ids)){
            $teams_ids = '';
        }
        if(empty($project_ids)){
            $project_ids = '';
        }
        
        $results = $departements->find()->contain(['Teams' => ['queryBuilder' => function ($q) use ($teams_ids) {
                                            return $q->where(['Teams.id IN' => $teams_ids])->order(['Teams.name' =>'ASC']);
                                        }], 
                                        'Teams.Projects' => 
                                        ['queryBuilder' => function ($q) use ($project_ids) {
                                            return $q->where(['Projects.id IN' => $project_ids])->order(['accomplishment' =>'ASC']);
                                        }], 
                                        'Teams.Projects.Priorities',
                                        'Teams.Projects.ProjectStages',
                                        'Teams.Users' => ['queryBuilder' => function ($q) {
                                            return $q->order(['Users.name' =>'ASC']);
                                        }],
                                        'Teams.Projects.Users' => ['queryBuilder' => function ($q) {
                                            return $q->where(['AssocUsersProjects.accessLevel >' => '1']);
                                        }], 'Criterions'])->where(['Departements.id' => $id]);

        $results = $results->toArray();
        //debug($results);die();
        //$results = $results->toArray();
        /*
        $results_assocWithComp = $departements->find()
                       ->innerJoinWith('Companies.Members', function ($q) use($user_id) {
                                            return $q->where(['Members.id' => $user_id, 'AssocCompaniesMembers.accessLevel >' => 0]);
                                        })->where(['Departements.id' => $id]);

        $results_assocWithDep = $departements->find()
                       ->innerJoinWith('Members', function ($q) use($user_id) {
                                            return $q->where(['Members.id' => $user_id, 'AssocDepartementsMembers.accessLevel >' => 0]);
                                        })->where(['Departements.id' => $id]);

        $results_assocWithTeam = $departements->find()
                       ->innerJoinWith('Teams.Members', function ($q) use($user_id) {
                                            return $q->where(['Members.id' => $user_id, 'AssocTeamsMembers.accessLevel >' => 0]);
                                        })->where(['Departements.id' => $id]);

        $results = $results_assocWithComp->union($results_assocWithDep);
        $results->union($results_assocWithTeam);

        $results = $results->contain(['Teams', 
                                        'Teams.Projects' => 
                                        ['queryBuilder' => function ($q) {
                                            return $q->order(['accomplishment' =>'ASC']);
                                        }], 
                                        'Teams.Projects.Priorities',
                                        'Teams.Projects.ProjectStages',
                                        'Teams.Users' => 
                                        ['queryBuilder' => function ($q) {
                                            return $q->order(['Users.name' =>'ASC']);
                                        }]
                                        ,'Teams.Projects.Users' => ['queryBuilder' => function ($q) {
                                            return $q->where(['AssocUsersProjects.accessLevel >' => '1']);
                                        }], 'Criterions']);/*->where(['Departements.id' => $id])->toArray()
        */
        /*
        $results = $results->toArray();
        */
        if(isset($results[0]['id'])) {
            return $results[0];
        }
        return false;
    }
    
    public function getThisDepCompany($id){
        $departements = TableRegistry::get('Departements');
        $result = $departements->find('all')->select(['company_id'])->where(['Departements.id' => $id])->first();
        return $result->company_id;
    }
    public function getThisDepCompanyId($id){
        $departements = TableRegistry::get('Departements');
        $result = $departements->find('all')->select(['company_id'])->where(['Departements.id' => $id])->first();
        return $result->company_id;
    }
    public function getAllDep(){
        $departements = TableRegistry::get('Departements');
        //$results = $departements->find('all')->contain(['Companies'])->order(['Departements.name' => 'ASC'])->toArray();
        $results = $departements->find('all')->contain(['Companies'])->order(['Departements.name' => 'ASC']);
        //$results = $departements->find('all')->toArray();
        return $results;
    }
    public function getAllDepByUser($user_type, $user_id, $group_manager){
        if($group_manager){
            return $this->getAllDep();
        }
        
        $entity = ($user_type == 'user') ? 'Users' : 'Members';
        
        $departements = TableRegistry::get('Departements');
        //if($user_type == 'user'){
            $results_assocWithComp = $departements->find()
                           ->innerJoinWith("Companies.$entity", function ($q) use($user_id, $entity) {
                                                return $q->where(["$entity.id" => $user_id, "AssocCompanies$entity.accessLevel >" => 0]);
                                            });
            
            $results_assocWithDep = $departements->find()
                           ->innerJoinWith("$entity", function ($q) use($user_id, $entity) {
                                                return $q->where(["$entity.id" => $user_id, "AssocDepartements$entity.accessLevel >" => 0]);
                                            });
            
            $results_assocWithTeam = $departements->find()
                           ->innerJoinWith('Teams.Users', function ($q) use($user_id, $entity) {
                                                return $q->where(['Users.id' => $user_id, 'AssocTeamsUsers.accessLevel >' => 0]);
                                            });
            $results = $results_assocWithComp->union($results_assocWithDep);
            if($user_type == 'user'){
                $results = $results_assocWithComp->union($results_assocWithTeam);
            }
            
            $results = $results->epilog('ORDER BY Departements__name ASC');
            $results = $results->contain(['Companies']);
            $deps_ids = array();
            foreach ($results as $dep) {
                $deps_ids[] = $dep->id;
            }
            return $deps_ids;
        //}elseif($user_type == 'member'){
            /*$results_assocWithComp = $departements->find()
                           ->innerJoinWith('Companies.Members', function ($q) use($user_id) {
                                                return $q->where(['Members.id' => $user_id, 'AssocCompaniesMembers.accessLevel >' => 0]);
                                            });
            $results_assocWithDep = $departements->find()
                           ->innerJoinWith('Members', function ($q) use($user_id) {
                                                return $q->where(['Members.id' => $user_id, 'AssocDepartementsMembers.accessLevel >' => 0]);
                                            });
            $results = $results_assocWithComp->union($results_assocWithDep);
            $results = $results->epilog('ORDER BY Departements__name ASC');
            $results = $results->contain(['Companies']);
            return $results;*/
        //}
    }
    
    public function departementsOfThisUser($user_type, $user_id, $group_manager) {
        if($group_manager){
            return $this->getAllDep();
        }
        $departementsTable = TableRegistry::get('Departements');
        $deps_ids = $this->getAllDepByUser($user_type, $user_id, $group_manager);
        if(empty($deps_ids)){
            $deps_ids = '';
        }
        $results = $departementsTable->find('all')->contain(['Companies'])->where(['Departements.id IN' => $deps_ids]);
        return $results;
        //}
        
        return null;
    }
    
    public function getCountDep(){
        $departements = TableRegistry::get('Departements');
        $results = $departements->find('list')->count();
        //$results = $departements->find('all')->toArray();
        return $results;
    }
    
    public function getCountTeamsByDep($id){
        $teams = TableRegistry::get('Departements');
        $results = $teams->find();
        $results->select(['total_teams' => $results->func()->count('Teams.id')])
            ->leftJoinWith('Teams')
            ->where(['Departements.id' => $id])
            ->group(['Departements.id'])
            ->autoFields(true);
        $results = $results->toArray();
        if(isset($results[0]['total_teams'])) {
            return $results[0]['total_teams'];
        }
        return false;
    }
    
    public function getCountProjectsByDep($id){
        $teams = TableRegistry::get('Departements');
        $results = $teams->find();
        $results->select(['total_projects' => $results->func()->count('Projects.id')])
            ->leftJoinWith('Teams.Projects')
            ->where(['Departements.id' => $id])
            ->group(['Departements.id'])
            ->autoFields(true);
        $results = $results->toArray();
        if(isset($results[0]['total_projects'])) {
            return $results[0]['total_projects'];
        }
        return false;
    }
    
    public function getCountUsersByDep($id){
        $departements = TableRegistry::get('Departements');
        $results = $departements->find();
        $results->select(['total_users' => $results->func()->count('Users.id')])
            ->leftJoinWith('Teams.Users')
            ->where(['Departements.id' => $id])
            ->group(['Departements.id'])
            ->autoFields(true);
        $results = $results->toArray();
        if(isset($results[0]['total_users'])) {
            return $results[0]['total_users'];
        }
        return false;
    }
    
    public function getusers_departement($dep_id) {
        $departementsTable = TableRegistry::get('Departements');
        $result = $departementsTable->find()->hydrate(false)->contain(['Teams.Users'])
                                            ->where(['Departements.id' => $dep_id])
                                            ->toArray();
        
        $users = array();
        if(!empty($result[0]['teams'])){
            foreach($result[0]['teams'] as $t => $team) {
                if(!empty($team['users'])){
                    foreach ($team['users'] as $u => $user) {
                        if(!in_array($user['id'], $users)){
                            $users[] = $user['id'];
                        }
                    }
                }
            }
        }
        return $users;
    }
    public function getUserAccessByDepartement($user_id, $type, $departement_id) {
        $departementsTable = TableRegistry::get('Departements');
        if($type === 'user'){
            $query = $departementsTable->find()->hydrate(false)->contain(['Users'])->where(['Departements.id' => $departement_id])
                        ->matching('Users', function ($q) use($user_id) {
                                                return $q->where(['Users.id' => $user_id]);
                                            })->first();
            return $query['_matchingData']['AssocDepartementsUsers']['accessLevel'];
        }elseif($type === 'member'){
            $query = $departementsTable->find()->hydrate(false)->contain(['Members'])->where(['Departements.id' => $departement_id])
                        ->matching('Members', function ($q) use($user_id) {
                                                return $q->where(['Members.id' => $user_id]);
                                            })->first();
            return $query['_matchingData']['AssocDepartementsMembers']['accessLevel'];
        }else{
            return 0;
        }
    }
    
    public function isDepartementManager($user_id, $departement_id, $type) {
        $departementsTable = TableRegistry::get('Departements');
        if($type === 'user'){    
            $query = $departementsTable->find()->hydrate(false)->contain(['Users'])->where(['Departements.id' => $departement_id])
                        ->matching('Users', function ($q) use($user_id) {
                                                return $q->where(['Users.id' => $user_id]);
                                            })->first();
            if($query['_matchingData']['AssocDepartementsUsers']['accessLevel'] == 5){
                return true;
            }
        }elseif($type === 'member'){
            $query = $departementsTable->find()->hydrate(false)->contain(['Members'])->where(['Departements.id' => $departement_id])
                        ->matching('Members', function ($q) use($user_id) {
                                                return $q->where(['Members.id' => $user_id]);
                                            })->first();
            if($query['_matchingData']['AssocDepartementsMembers']['departementManager'] == 5){
                return true;
            }
        }
        return false;
    }
    
    public function heIsADepartementManager($user_id, $type) {
        $departementsTable = TableRegistry::get('Departements');
        $entity = ($type === 'user') ? 'Users' : 'Members';
        
        $query = $departementsTable->find()->hydrate(false)->contain([$entity])
                    ->matching($entity, function ($q) use($user_id, $entity) {
                                            return $q->where([$entity.'.id' => $user_id, "AssocDepartements$entity.accessLevel" => 5]);
                                        });
        if($query->count() > 0) {
            return true;
        }
        return false;
    }
}
