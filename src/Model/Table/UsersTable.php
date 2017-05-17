<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\ORM\TableRegistry;

/**
 * Users Model
 *
 * @property \Cake\ORM\Association\HasMany $AssocTeamsUsers
 * @property \Cake\ORM\Association\HasMany $AssocUsersActiondisciplinaires
 * @property \Cake\ORM\Association\HasMany $AssocUsersProjects
 * @property \Cake\ORM\Association\HasMany $Rapports
 *
 * @method \App\Model\Entity\User get($primaryKey, $options = [])
 * @method \App\Model\Entity\User newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\User[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\User|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\User patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\User[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\User findOrCreate($search, callable $callback = null)
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class UsersTable extends Table
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

        $this->table('users');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        /*$this->hasMany('AssocTeamsUsers', [
            'foreignKey' => 'user_id'
        ]);*/
        $this->belongsToMany('Teams', [
            'joinTable' => 'assoc_teams_users',
            'through' => 'AssocTeamsUsers'
        ]);
        /*$this->hasMany('AssocUsersActiondisciplinaires', [
            'foreignKey' => 'user_id'
        ]);*/
        $this->belongsToMany('Actiondisciplinaires', [
            'joinTable' => 'assoc_users_actiondisciplinaires',
        ]);
        /*$this->hasMany('AssocUsersProjects', [
            'foreignKey' => 'user_id'
        ]);*/
        $this->belongsToMany('Projects', [
            'joinTable' => 'assoc_users_projects',
            'through' => 'AssocUsersProjects'
        ]);
        
        $this->belongsToMany('Companies', [
            'joinTable' => 'assoc_companies_users',
            'through' => 'AssocCompaniesUsers'
        ]);
        $this->belongsToMany('Departements', [
            'joinTable' => 'assoc_departements_users',
            'through' => 'AssocDepartementsUsers'
        ]);
        
        $this->hasMany('Rapports', [
            'foreignKey' => 'user_id'
        ]);
        
        $this->belongsToMany('Criterions', [
            'foreignKey' => 'user_id',
            'targetForeignKey' => 'criterion_id',
            'joinTable' => 'assoc_users_criterions',
            'through' => 'AssocUsersCriterions'
        ]);
        
        $this->hasOne('Authentifications', [
            'ForeignKey' => 'User_id'
        ]);
        
        $this->hasMany('UserUrls', [
            'className' => 'UserUrls'
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
                'field' => ['name', 'lastName', 'description']
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
            ->requirePresence('lastName', 'create')
            ->notEmpty('lastName');
        /*
        $validator
            ->requirePresence('password', 'create')
            ->notEmpty('password');
        */
        /*
        $validator
            ->email('email')
            ->requirePresence('email', 'create')
            ->notEmpty('email')
            ->add('email', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);
        */
        $validator
            ->allowEmpty('description');

        $validator
            ->allowEmpty('path_image');

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

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    /*public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->isUnique(['email']));

        return $rules;
    }*/
    
    public function getCountEmp() {
        $users = TableRegistry::get('Users');
        $result = $users->find('list')->count();
        return $result;
    }
    
    public function getCountEmpByUser($user_type, $user_id, $group_manager) {
        if($group_manager){
            return $this->getCountEmp();
        }
        $users = $this->getAllEmployeesDataByUser($user_type, $user_id, $group_manager);
        return count($users);
    }
    
    public function getUserDataById($id) {
        $users = TableRegistry::get('Users');
        $result = $users->find('all')->contain(['Authentifications'])->where(['Users.id' => $id])->order(['name' => 'ASC'])->first();
        return $result;
    }
    
    public function getAllUserDataById($id) {
        $users = TableRegistry::get('Users');
        $result = $users->find('all')->contain(['Authentifications', 'Teams' => ['queryBuilder' => function ($q) {
                                                return $q->where(['AssocTeamsUsers.accessLevel >' => '1']);
                                            }], 'Projects' => ['queryBuilder' => function ($q) {
                                                return $q->where(['AssocUsersProjects.accessLevel >' => '1']);
                                            }], 'Criterions', 'Teams.Projects', 'Teams.Departements', 'Rapports', 'UserUrls'])
                                    ->where(['Users.id' => $id])->order(['name' => 'ASC'])->toArray();
        
        return $result[0];
    }
    
    public function getUserTeams($id) {
        $users = TableRegistry::get('Users');
        $result = $users->find('all')->contain(['Teams' => ['queryBuilder' => function ($q) {
                                                return $q->where(['AssocTeamsUsers.accessLevel >' => '1']);
                                            }]])
                                    ->where(['Users.id' => $id])->first();
        
        return $result;
    }
    
    public function getAllEmployeesData() {
        $users = TableRegistry::get('Users');
        $result = $users->find('all')->contain(['Authentifications', 'Teams' => ['queryBuilder' => function ($q) {
                                                return $q->where(['AssocTeamsUsers.accessLevel >' => '1']);
                                            }], 'Teams.Projects', 'Teams.Departements', 'Rapports', 'Criterions'])->order(['name' => 'ASC'])->toArray();
        return $result;
    }
    
    public function getAllEmployeesDataByUser($user_type, $user_id, $group_manager) {
        if($group_manager){
            return $this->getAllEmployeesData();
        }
        $users = TableRegistry::get('Users');
        if($user_type == 'user'){
            $entity = 'Users';
            $table = TableRegistry::get('Users');
        }elseif($user_type == 'member'){
            $entity = 'Members';
            $table = TableRegistry::get('Members');
        }
        //Récupérer tous les id de societe sur les quelles cet utilisateur a l'access
        $UserCompaniesIds = $table->find('all')->contain(['Companies' => ['queryBuilder' => function ($q) use ($entity) {
                                            return $q->where(["AssocCompanies$entity.accessLevel >" => 0]);
                                        }]])->where(["$entity.id" => $user_id])->first();

        $companiesIds = array();
        foreach ($UserCompaniesIds->companies as $key => $company) {
            $companiesIds[] = $company->id;
        }
        
        //Recuperer tous les utilisteur qui appartient à ces societés 
        $results_HaveAccessOnComps = null;
        if(!empty($companiesIds)){
            $results_HaveAccessOnComps = $users->find()
                       ->innerJoinWith('Teams.Departements.Companies', function ($q) use($companiesIds) {
                                            return $q->where(['Companies.id IN' => $companiesIds]);
                                        })->distinct();
        }
        //Récupérer tous les id des departements sur les quels cet utilisateur a l'access
        $UserDepsIds = $table->find('all')->contain(['Departements' => ['queryBuilder' => function ($q) use ($entity) {
                                            return $q->where(["AssocDepartements$entity.accessLevel >" => 0]);
                                        }]])->where(["$entity.id" => $user_id])->first();

        foreach ($UserDepsIds->departements as $key => $dep) {
            $depsIds[] = $dep->id;
        }

        //Recuperer tous les utilisteur qui appartient à ces societés 
        $results_HaveAccessOnDeps = null;
        if(!empty($depsIds)){
            $results_HaveAccessOnDeps = $users->find()
                       ->innerJoinWith('Teams.Departements', function ($q) use($depsIds) {
                                            return $q->where(['Departements.id IN' => $depsIds]);
                                        })->distinct();
        }
        
        //Récupérer ses collegues dans cette société
        $UserCompaniesIds = $table->find('all')//->contain(['Teams', 'Teams.Departements'])->where(['Users.id' => $user_id])->first();
                                ->innerJoinWith('Teams.Departements', function ($q) use($companiesIds) {
                                            return $q->select(['Departements.company_id']);
                                        })->where(["$entity.id" => $user_id])->first();
        
        $companiesIds = array();
        if(!empty($UserCompaniesIds)){
            foreach ($UserCompaniesIds->_matchingData as $key => $company) {
                $companiesIds[] = $company->company_id;
            }
        }
        //Récupérer les collégues selon les ids des sociétés
        $results_Collaborater = null;
        if(!empty($companiesIds)){
            $results_Collaborater = $users->find()
                       ->innerJoinWith('Teams.Departements', function ($q) use($companiesIds) {
                                            return $q->where(['Departements.company_id IN' => $companiesIds]);
                                        })->distinct();
        }

        //$results_HaveAccessOnComps $results_HaveAccessOnDeps $results_Collaborater
        $results = array();
        if(!empty($results_HaveAccessOnComps)){
            $results_HaveAccessOnComps->contain(['Authentifications', 'Teams' => ['queryBuilder' => function ($q) {
                                            return $q->where(['AssocTeamsUsers.accessLevel >' => '1']);
                                        }], 'Teams.Projects', 'Teams.Departements', 'Rapports', 'Criterions']);
            $results = $results_HaveAccessOnComps;
        }
        if(!empty($results_HaveAccessOnDeps)){
            $results_HaveAccessOnDeps->contain(['Authentifications', 'Teams' => ['queryBuilder' => function ($q) {
                                                return $q->where(['AssocTeamsUsers.accessLevel >' => '1']);
                                            }], 'Teams.Projects', 'Teams.Departements', 'Rapports', 'Criterions']);
            $results = (empty($results)) ? $results_HaveAccessOnDeps : $results->union($results_HaveAccessOnDeps);
        }
        if(!empty($results_Collaborater)){
            $results_Collaborater->contain(['Authentifications', 'Teams' => ['queryBuilder' => function ($q) {
                                                return $q->where(['AssocTeamsUsers.accessLevel >' => '1']);
                                            }], 'Teams.Projects', 'Teams.Departements', 'Rapports', 'Criterions']);
            $results = (empty($results)) ? $results_Collaborater : $results->union($results_Collaborater);
        }
        if(!empty($results)) {
            $results = $results->epilog('ORDER BY Users__name ASC')->toArray();
        }
        return $results;
        
    }
    
    public function getEmployeesList() {
        $users = TableRegistry::get('Users');
        $result = $users->find('list', ['keyField' => 'id', 'valueField' => function ($row) { 
                                                                                return $row['name'] . ' ' . $row['lastName'];
                                                                            }])
                        ->order(['name' => 'ASC'])
                        ->toArray();
        return $result;
    }
    
    public function getUsersByIdDep($dep_id){
        $users = TableRegistry::get('Users');
        $results = $users->find()->select(['id', 'name', 'lastName'])->order(['Users.name' => 'ASC'])->contain(['Teams']);
        $results = $results->matching('Teams', function ($q) use ($dep_id) {
                                            return $q->where(['AssocTeamsUsers.accessLevel >' => '1', 'Teams.departement_id' => $dep_id])->autoFields(false);
                                        })->autoFields(false)->toArray();
        if(isset($results)) {
            return array_unique($results); //array unique pour supprimer la duplication
        }
        return false;
    }
    
    public function userInTeams($user_id, $team_ids) {
        $users = TableRegistry::get('Users');
        $results = $users->find()->select(['id', 'name', 'lastName'])->contain(['Teams'])->where(['Users.id' => $user_id]);
        if(empty($team_ids)){
            $team_ids = '';
        }
        $results = $results->matching('Teams', function ($q) use ($team_ids) {
                                            return $q->where(['AssocTeamsUsers.accessLevel >' => '1', 'Teams.id IN' => $team_ids])->autoFields(false);
                                        })->autoFields(false);
        if(empty($results->toArray())){
            return false;
        }else{
            return true;
        }
    }
    
    public function update_path_image($id, $var) {
        $users = TableRegistry::get('Users');
        $query = $users->query();
        $query->update()
                ->set(['path_image' => $var])
                ->where(['id' => $id])
                ->execute();
    }
    
    public function update_authentificationid_byiduser($user_id, $auth_id) {
        $users = TableRegistry::get('Users');
        $query = $users->query();
        $query->update()
                ->set(['authentification_id' => $auth_id])
                ->where(['id' => $user_id])
                ->execute();
    }
    
    //GET DATA BY ASSOCIATIONS CONDITIONS
    /*public function getUsersOfTeam($team_id) {
        $usersTable = TableRegistry::get('Users');
        $results = $usersTable->find()->hydrate(false)->contain(['Teams'])
                                            ->matching('Teams')
                                            ->where(['AssocTeamsUsers.team_id' => $team_id, 'AssocTeamsUsers.accessLevel' => 2])
                                            ->toArray();
        
        $users = array();
        debug($results);die();
        foreach($results[0]['users'] as $u => $user) {
            if(!in_array($user['id'], $users)){
                $users[] = $user['id'];
            }
        }
        
        //debug($users);die();
        return $users;
    }*/
}
