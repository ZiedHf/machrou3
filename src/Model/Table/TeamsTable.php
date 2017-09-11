<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\ORM\TableRegistry;

/**
 * Teams Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Departements
 * @property \Cake\ORM\Association\HasMany $AssocProjectsTeams
 * @property \Cake\ORM\Association\HasMany $AssocTeamsUsers
 *
 * @method \App\Model\Entity\Team get($primaryKey, $options = [])
 * @method \App\Model\Entity\Team newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Team[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Team|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Team patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Team[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Team findOrCreate($search, callable $callback = null)
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class TeamsTable extends Table
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

        $this->table('teams');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Departements', [
            'foreignKey' => 'departement_id'
        ]);
        
        $this->belongsToMany('Projects', [
            'joinTable' => 'assoc_projects_teams',
        ]);
        
        $this->belongsToMany('Users', [
            'joinTable' => 'assoc_teams_users',
            'through' => 'AssocTeamsUsers'
        ]);
        $this->belongsToMany('Members', [
            'joinTable' => 'assoc_teams_members',
        ]);
        
        $this->belongsToMany('Criterions', [
            'joinTable' => 'assoc_teams_criterions',
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
                'field' => ['name', 'description', 'Departements.name']
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
            ->allowEmpty('path_image');

        $validator
            ->integer('departement_id')
            ->notEmpty('departement_id', 'Please fill this field');
        
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
        $rules->add($rules->existsIn(['departement_id'], 'Departements'));

        return $rules;
    }
    
    public function getCountTeams() {
        $teams = TableRegistry::get('Teams');
        $result = $teams->find('list')->count();
        return $result;
    }
    public function getCountTeamsByUser($user_type, $user_id, $group_manager){
        if($group_manager){
            return $this->getCountTeams();
        }
        $teams = $this->getTeamsDataByUser($user_type, $user_id, $group_manager);
        return count($teams);
    }
    
    /*public function getCountProjectsByTeams($id){
        $teams = TableRegistry::get('Teams');
        $results = $teams->find();
        $results->select(['total_projects' => $results->func()->count('Projects.id')])
            ->leftJoinWith('Projects')
            ->where(['Teams.id' => $id])
            ->group(['Teams.id'])
            ->autoFields(true);
        $total = $results->toArray();
        debug($total);die();
        return $results;
    }*/
    public function getTeamsList(){
        $teams = TableRegistry::get('Teams');
        $results = $teams->find('list')->order(['name' => 'ASC']);
        return $results;
    }
    
    public function getTeamsHaveDepList(){
        $teams = TableRegistry::get('Teams');
        $results = $teams->find('list', ['conditions' => ['not' => ['Teams.departement_id' => 'NULL']]])->order(['name' => 'ASC']);
        return $results;
    }
    
    public function getTeamDataById($id){
        $teams = TableRegistry::get('Teams');
        $results = $teams->find('all')->contain(['Users' => ['queryBuilder' => function ($q) {
                                                            return $q->where(['AssocTeamsUsers.accessLevel >' => '1']);
                                                        }], 'Departements', 'Projects', 'Criterions'])->where(['Teams.id' => $id])->first();
        return $results;
    }
    
    public function getThisTeamDataByUser($id, $user_type, $user_id, $group_manager){
        
        if($group_manager){
            return $this->getTeamDataById($id);
        }
        
        $teams = TableRegistry::get('Teams');
        
        $entity = ($user_type == 'user') ? 'Users' : 'Members';
        
        //If this user a l'access a cette societe alors on lui donne l'access
        $results_assocWithComp = $teams->find()
                       ->innerJoinWith("Departements.Companies.$entity", function ($q) use($user_id, $entity) {
                                            return $q->where(["$entity.id" => $user_id, "AssocCompanies$entity.accessLevel >" => 0]);
                                        })->where(['Teams.id' => $id]);
        if($results_assocWithComp->count() > 0){
            return $this->getTeamDataById($id);
        } 
        
        //If this user a l'access a ce dep alors on lui donne l'access
        $results_assocWithDep = $teams->find()
                       ->innerJoinWith("Departements.$entity", function ($q) use ($user_id, $entity) {
                                            return $q->where(["$entity.id" => $user_id, "AssocDepartements$entity.accessLevel >" => 0]);
                                        })->where(['Teams.id' => $id]);
        
        if($results_assocWithDep->count() > 0){
            return $this->getTeamDataById($id);
        }  
        
        $results_assocWithTeam = $teams->find()
                       ->innerJoinWith("$entity", function ($q) use ($user_id, $entity) {
                                            return $q->where(["$entity.id" => $user_id, "AssocTeams$entity.accessLevel >" => 4]);
                                        })->where(['Teams.id' => $id]);
        //debug($results_assocWithTeam->toArray());die();
        if($results_assocWithTeam->count() > 0){
            return $this->getTeamDataById($id);
        }  
        
        //If this user a l'access a une equipe de cette dep on affiche seulement les info de cette equipes
        /*$results_assocWithTeam = $teams->find()
                       ->matching("Teams.$entity", function ($q) use ($user_id, $entity) {
                                            return $q->where(["$entity.id" => $user_id, "AssocTeams$entity.accessLevel >" => 0]);
                                        })->where(['Teams.id' => $id]);
        foreach ($results_assocWithTeam as $dep) {
            $teams_ids[] = $dep->_matchingData['Teams']->id;
        }
        */
        
        $projectsTable = TableRegistry::get('Projects');
        $projectsOfThisUser = $projectsTable->getAllProjectDataByUser(null, $user_type, $user_id, $group_manager);
        foreach ($projectsOfThisUser as $key => $project) {
            $project_ids[] = $project->id;
        }
        
        if(empty($project_ids)){
            $project_ids = '';
        }
        
        $results = $teams->find('all')->contain(['Users' => ['queryBuilder' => function ($q) {
                                                            return $q->where(['AssocTeamsUsers.accessLevel >' => '1']);
                                                        }], 
                                                'Departements', 
                                                'Projects' => 
                                                    ['queryBuilder' => function ($q) use ($project_ids) {
                                                        return $q->where(['Projects.id IN' => $project_ids])->order(['accomplishment' =>'ASC']);
                                                    }], 
                                                'Criterions'])->where(['Teams.id' => $id])->first();
        
        return $results;
    }
    
    public function getTeamsData(){
        $teams = TableRegistry::get('Teams');
        $results = $teams->find('all')->contain(['Users' => ['queryBuilder' => function ($q) {
                                                            return $q->where(['AssocTeamsUsers.accessLevel >' => '1']);
                                                        }], 'Departements', 'Projects', 'Criterions'])->order(['Teams.name' => 'ASC']);
        return $results;
    }
    
//    public function getTeamsIdsByThisSessionAuth($user_type, $user_id, $group_manager){
//        if($group_manager){
//            return $this->getTeamsData();
//        }
//        
//        $teams = TableRegistry::get('Teams');
//        $teams_ids = array();
//        $entity = ($user_type === 'user') ? 'Users' : 'Members';
//        
//        $results = $teams->find()->select('id')
//                           ->innerJoinWith('Departements.Companies.'.$entity, function ($q) use($user_id, $entity) {
//                                                return $q->where([$entity.'.id' => $user_id, 'accessLevel' > 0]);
//                                            });
//                                            
//        foreach ($results as $key => $team) {
//            $teams_ids[] = $team->id;
//        }
//        $results = $teams->find()->select('id')
//                           ->innerJoinWith('Departements.'.$entity, function ($q) use($user_id, $entity) {
//                                                return $q->where([$entity.'.id' => $user_id, 'accessLevel' > 0]);
//                                            });
//                                            
//        foreach ($results as $key => $team) {
//            $teams_ids[] = $team->id;
//        }
//        $results = $teams->find()->select('id')
//                           ->innerJoinWith($entity, function ($q) use($user_id, $entity) {
//                                                return $q->where([$entity.'.id' => $user_id]);
//                                            });
//                                            
//        foreach ($results as $key => $team) {
//            $teams_ids[] = $team->id;
//        }
//        
//        debug($teams_ids); die();
//    }
    
    public function getTeamsDataByUser($user_type, $user_id, $group_manager){
        if($group_manager){
            //return $this->getTeamsData()->toArray();
            return $this->getTeamsData();
        }
        
        $teams = TableRegistry::get('Teams');
        $entity = ($user_type === 'user') ? 'Users' : 'Members';
        //Get All Teams By Companies assoc privilege
        $results_assocWithComp = $teams->find()
                       ->innerJoinWith('Departements.Companies.'.$entity, function ($q) use($user_id, $entity) {
                                            return $q->where([$entity.'.id' => $user_id]);
                                        });
        //Get All Teams By departement assoc privilege
        $results_assocWithDep = $teams->find()
                       ->innerJoinWith('Departements.'.$entity, function ($q) use($user_id, $entity) {
                                            return $q->where([$entity.'.id' => $user_id]);
                                        });
        
        //Get All Teams By Privilege
        $results_assocWithTeams = $teams->find()
                       ->innerJoinWith($entity, function ($q) use($user_id, $entity) {
                                            return $q->where([$entity.'.id' => $user_id]);
                                        });
        $results = $results_assocWithComp->union($results_assocWithDep);
        $results->union($results_assocWithTeams);
        //debug($results->toArray());die();

        $results = $results->contain([$entity => ['queryBuilder' => function ($q) use ($entity) {
                                                            return $q->where(['AssocTeams'.$entity.'.accessLevel >' => '1']);
                                                        }], 'Departements', 'Projects', 'Criterions'])->order(['Teams.name' => 'ASC']);
        return $results;
        
    }
    
    public function getCountProjectsByTeam($id){
        $teams = TableRegistry::get('Teams');
        $results = $teams->find();
        $results->select(['total_projects' => $results->func()->count('Projects.id')])
                ->leftJoinWith('Projects')
                ->where(['Teams.id' => $id])
                ->group(['Teams.id']);
        $results = $results->toArray();
        if(isset($results[0]['total_projects'])) {
            return $results[0]['total_projects'];
        }
        return false;
    }
    
    public function getCountUsersByTeam($id){        
        $teams = TableRegistry::get('Teams');
        $results = $teams->find();
        $results->select(['total_users' => $results->func()->count('Users.id')])
            ->leftJoinWith('Users')
            ->where(['Teams.id' => $id, 'AssocTeamsUsers.accessLevel >' => '1'])
            ->group(['Teams.id']);
        $results = $results->toArray();
        //debug($results);die();
        if(isset($results[0]['total_users'])) {
            return $results[0]['total_users'];
        }
        return false;
    }
    
    public function update_path_image($id, $var) {
        $teams = TableRegistry::get('Teams');
        $query = $teams->query();
        $query->update()
                ->set(['path_image' => $var])
                ->where(['id' => $id])
                ->execute();
    }
    
    public function getusers_team($team_id) {
        $teamsTable = TableRegistry::get('Teams');
        $result = $teamsTable->find()->hydrate(false)->contain(['Users' => ['queryBuilder' => function ($q) {
                                                            return $q->where(['AssocTeamsUsers.accessLevel >' => '1']);
                                                        }]])->where(['Teams.id' => $team_id])->toArray();
        
        $users = array();
        foreach($result[0]['users'] as $u => $user) {
            if(!in_array($user['id'], $users)){
                $users[] = $user['id'];
            }
        }
        
        return $users;
    }
    
    public function getNotMembersTeam($team_id) {
        $teamsTable = TableRegistry::get('Teams');
        $result = $teamsTable->find()->hydrate(false)->contain(['Users' => ['queryBuilder' => function ($q) {
                                                            return $q->where(['AssocTeamsUsers.accessLevel <' => '2']);
                                                        }]])->where(['Teams.id' => $team_id])->toArray();
        
        $users = array();
        foreach($result[0]['users'] as $u => $user) {
            if(!in_array($user['id'], $users)){
                $users[] = $user['id'];
            }
        }
        
        return $users;
    }
    
    public function getThisTeamCompanyId($team_id){
        $teams = TableRegistry::get('Teams');
        $result = $teams->find('all')->select(['Departements.company_id'])->hydrate(false)->contain(['Departements'])->where(['Teams.id' => $team_id])->first();
        return $result['Departements']['company_id'];
    }
    
    public function getThisTeamDepId($team_id){
        $teams = TableRegistry::get('Teams');
        $result = $teams->find('all')->select(['Departements.id'])->hydrate(false)->contain(['Departements'])->where(['Teams.id' => $team_id])->first();
        return $result['Departements']['id'];
    }
    
    public function getUserAccessByTeam($user_id, $type, $team_id) {
        $teamsTable = TableRegistry::get('Teams');
        if($type === 'user'){
            $query = $teamsTable->find()->hydrate(false)->contain(['Users'])->where(['Teams.id' => $team_id])
                        ->matching('Users', function ($q) use($user_id) {
                                                return $q->where(['Users.id' => $user_id]);
                                            })->first();
            return $query['_matchingData']['AssocTeamsUsers']['accessLevel'];
        }elseif($type === 'member'){
            $query = $teamsTable->find()->hydrate(false)->contain(['Members'])->where(['Teams.id' => $team_id])
                        ->matching('Members', function ($q) use($user_id) {
                                                return $q->where(['Members.id' => $user_id]);
                                            })->first();
            return $query['_matchingData']['AssocTeamsMembers']['accessLevel'];
        }else{
            return 0;
        }
    }
    
    public function isTeamManager($user_id, $team_id, $type) {
        $teamsTable = TableRegistry::get('Teams');
        if($type === 'user'){    
            $query = $teamsTable->find()->hydrate(false)->contain(['Users'])->where(['Teams.id' => $team_id])
                        ->matching('Users', function ($q) use($user_id) {
                                                return $q->where(['Users.id' => $user_id]);
                                            })->first();
            if($query['_matchingData']['AssocTeamsUsers']['accessLevel'] == 5){
                return true;
            }
        }elseif($type === 'member'){
            $query = $teamsTable->find()->hydrate(false)->contain(['Members'])->where(['Teams.id' => $team_id])
                        ->matching('Members', function ($q) use($user_id) {
                                                return $q->where(['Members.id' => $user_id]);
                                            })->first();;
            if($query['_matchingData']['AssocTeamsMembers']['teamManager'] == 5){
                return true;
            }
        }
        return false;
    }
    
    public function heIsATeamManager($user_id, $type) {
        $teamsTable = TableRegistry::get('Teams');
        if($type === 'user'){    
            $query = $teamsTable->find()->hydrate(false)->contain(['Users'])
                        ->matching('Users', function ($q) use($user_id) {
                                                return $q->where(['Users.id' => $user_id, 'AssocTeamsUsers.accessLevel' => 5]);
                                            });
            if($query->count() > 0) {
                return true;
            }
        }elseif($type === 'member'){
            $query = $teamsTable->find()->hydrate(false)->contain(['Members'])
                        ->matching('Members', function ($q) use($user_id) {
                                                return $q->where(['Members.id' => $user_id, 'AssocTeamsMembers.accessLevel' => 5]);
                                            })->first();
            if($query->count() > 0) {
                return true;
            }
        }
        return false;
    }
}
