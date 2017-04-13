<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\ORM\TableRegistry;
use Cake\Datasource\ConnectionManager;

/**
 * Companies Model
 *
 * @property \Cake\ORM\Association\HasMany $AssocCompaniesMembers
 * @property \Cake\ORM\Association\HasMany $AssocCompaniesUsers
 * @property \Cake\ORM\Association\HasMany $Departements
 *
 * @method \App\Model\Entity\Company get($primaryKey, $options = [])
 * @method \App\Model\Entity\Company newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Company[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Company|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Company patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Company[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Company findOrCreate($search, callable $callback = null)
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class CompaniesTable extends Table
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

        $this->table('companies');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');
        
        $this->belongsToMany('Members', [
            'joinTable' => 'assoc_companies_members',
            'through' => 'AssocCompaniesMembers'
        ]);
        $this->belongsToMany('Users', [
            'joinTable' => 'assoc_companies_users',
            'through' => 'AssocCompaniesUsers'
        ]);
        /*
        $this->hasMany('AssocCompaniesMembers', [
            'foreignKey' => 'company_id'
        ]);
        $this->hasMany('AssocCompaniesUsers', [
            'foreignKey' => 'company_id'
        ]);*/
        $this->hasMany('Departements', [
            'foreignKey' => 'company_id'
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
            ->email('email')
            ->allowEmpty('email');

        $validator
            ->allowEmpty('adresse');

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
        $rules->add($rules->isUnique(['email']));

        return $rules;
    }
    
    public function getAllCompaniesData(){
        $companiesTable = TableRegistry::get('Companies');
        $results = $companiesTable->find('all')->contain(['Departements', 'Departements.Teams', 'Departements.Teams.Projects', 'Departements.Teams.Users'])->order(['name' => 'ASC']);
        return $results;
    }
    
    public function getAllCompaniesDataByUser($user_type, $user_id, $group_manager){
        if($group_manager){
            return $this->getAllCompaniesData();
        }
        
        $companiesTable = TableRegistry::get('Companies');
        if($user_type == 'user'){
            $results_UsersAsMembers = $companiesTable->find()->contain(['Departements', 'Departements.Teams', 'Departements.Teams.Projects', 'Departements.Teams.Users'])
                    ->innerJoinWith('Departements.Teams.Users', function ($q) use($user_id) {
                                                return $q->where(['Users.id' => $user_id]);
                                            });
                                            
            $results_assocWithUsers = $companiesTable->find()->contain(['Departements', 'Departements.Teams', 'Departements.Teams.Projects', 'Departements.Teams.Users'])
                    ->innerJoinWith('Users', function ($q) use($user_id) {
                                                return $q->where(['Users.id' => $user_id, 'AssocCompaniesUsers.accessLevel >' => 0]);
                                            });
                     
            $results_assocWithDeps = $companiesTable->find()->contain(['Departements', 'Departements.Teams', 'Departements.Teams.Projects', 'Departements.Teams.Users'])
                    ->innerJoinWith('Departements.Users', function ($q) use($user_id) {
                                                return $q->where(['AssocDepartementsUsers.user_id' => $user_id, 'AssocDepartementsUsers.accessLevel >' => 0]);
                                            });
                                            
            $results = $results_UsersAsMembers->union($results_assocWithUsers);
            $results->union($results_assocWithDeps);
            $results->order(['Companies.name' => 'ASC']);
            
            return $results;
        }elseif($user_type == 'member'){
            $results_assocWithMembers = $companiesTable->find()->contain(['Departements', 'Companies.Members'])
                    ->innerJoinWith('Companies.Members', function ($q) use($user_id) {
                                                return $q->where(['Members.id' => $user_id, 'AssocCompaniesMembers.accessLevel >' => 0]);
                                            });
                                            
            $results_assocWithDeps = $companiesTable->find()->contain(['Departements', 'Companies.Members'])
                    ->innerJoinWith('Departements.Members', function ($q) use($user_id) {
                                                return $q->where(['AssocDepartementsMembers.member_id' => $user_id, 'AssocDepartementsMembers.accessLevel >' => 0]);
                                            });
            $results = $results_assocWithMembers->union($results_assocWithDeps);
            $results->order(['Companies.name' => 'ASC']);
            return $results;
        }
        
        return null;
        
    }
    
    public function getCompaniesIdsByUser($user_type, $user_id, $group_manager){
        if($group_manager){
            return $this->getAllCompaniesData();
        }
        $entity = ($user_type == 'user') ? 'Users' : 'Members';
        $companiesTable = TableRegistry::get('Companies');
        //if($user_type == 'user'){
        $results_UsersAsMembers = ($user_type == 'user') ? 
                                        $companiesTable->find()
                                        ->innerJoinWith('Departements.Teams.Users', function ($q) use($user_id) {
                                                                    return $q->where(['Users.id' => $user_id]);
                                                                })
                                                        : null;

        $results_assocWithUsers = $companiesTable->find()
                ->innerJoinWith('Users', function ($q) use($user_id, $entity) {
                                            return $q->where(["$entity.id" => $user_id, "AssocCompanies$entity.accessLevel >" => 0]);
                                        });

        $results_assocWithDeps = $companiesTable->find()
                ->innerJoinWith('Departements.Users', function ($q) use($user_id, $entity, $user_type) {
                                            return $q->where(["AssocDepartements$entity.".$user_type."_id" => $user_id, "AssocDepartements$entity.accessLevel >" => 0]);
                                        });

        $results = $results_UsersAsMembers->union($results_assocWithUsers);
        $results->union($results_assocWithDeps);
        //$results->order(['Companies.name' => 'ASC']);
        foreach ($results as $company) {
            $companies_ids[] = $company->id;
        }
        return $companies_ids;
        /*}elseif($user_type == 'member'){
            $results_assocWithMembers = $companiesTable->find()->contain(['Departements', 'Companies.Members'])
                    ->innerJoinWith('Companies.Members', function ($q) use($user_id) {
                                                return $q->where(['Members.id' => $user_id, 'AssocCompaniesMembers.accessLevel >' => 0]);
                                            });
                                            
            $results_assocWithDeps = $companiesTable->find()->contain(['Departements', 'Companies.Members'])
                    ->innerJoinWith('Departements.Members', function ($q) use($user_id) {
                                                return $q->where(['AssocDepartementsMembers.member_id' => $user_id, 'AssocDepartementsMembers.accessLevel >' => 0]);
                                            });
            $results = $results_assocWithMembers->union($results_assocWithDeps);
            $results->order(['Companies.name' => 'ASC']);
            return $results;
        }
        */
    }
    public function companiesOfThisUser($user_type, $user_id, $group_manager) {
        $companiesTable = TableRegistry::get('Companies');
        //$this->user_type, $this->user_id, $this->Auth->user('group_manager')
        $companies_ids = $this->getCompaniesIdsByUser($user_type, $user_id, $group_manager);
        if(!empty($companies_ids)){
            $results = $companiesTable->find('all')->where(['id IN' => $companies_ids]);
            return $results;
        }
        return null;
    }
    public function getCountDep(){
        $companiesTable = TableRegistry::get('Companies');
        $results = $companiesTable->find('list')->count();
        //$results = $departements->find('all')->toArray();
        return $results;
    }
    
    public function getCompanies() {
        $companiesTable = TableRegistry::get('Companies');
        $results = $companiesTable->find('list');
        return $results;
    }
    
    /*public function getcompany_departements($company_id){
        $companiesTable = TableRegistry::get('Companies');
        $result = $companiesTable->find('all')->contain(['Departements'])->toArray();
        return $result;
    }*/
    public function getcompany_ids_departements($company_id){
        $companiesTable = TableRegistry::get('Companies');
        $result = $companiesTable->find('all')->select(['dep.id'])
                                                ->hydrate(false)
                                                ->join(['dep' => [
                                                                    'table' => 'Departements',
                                                                    'type' => 'inner',
                                                                    'conditions' => 'dep.company_id = companies.id'
                                                                    ]
                                                            ])
                                            ->where(['Companies.id' => $company_id])
                                            ->toArray();
        return $result;
    }
    
    public function getusers_company($company_id){
        $companiesTable = TableRegistry::get('Companies');
        $result = $companiesTable->find()->hydrate(false)->contain(['Departements.Teams.Users'])
                                            ->where(['Companies.id' => $company_id])
                                            ->toArray();
        $users = array();
        if(!empty($result[0]['departements'])){
            foreach ($result[0]['departements'] as $d => $departement) {
                if(!empty($departement['teams'])){
                    foreach ($departement['teams'] as $t => $team) {
                        if(!empty($team['users'])){
                            foreach ($team['users'] as $u => $user) {
                                if(!in_array($user['id'], $users)){
                                    $users[] = $user['id'];
                                }
                            }
                        }
                    }
                }
            }
        }
        return $users;
    }
    
    public function getUserAccessByCompany($user_id, $type, $company_id) {
        $companiesTable = TableRegistry::get('Companies');
        if($type === 'user'){
            $query = $companiesTable->find()->hydrate(false)->contain(['Users'])->where(['Companies.id' => $company_id])
                        ->matching('Users', function ($q) use($user_id) {
                                                return $q->where(['Users.id' => $user_id]);
                                            })->first();
            return $query['_matchingData']['AssocCompaniesUsers']['accessLevel'];
        }elseif($type === 'member'){
            $query = $companiesTable->find()->hydrate(false)->contain(['Members'])->where(['Companies.id' => $company_id])
                    ->matching('Members', function ($q) use($member_id) {
                                            return $q->where(['Members.id' => $member_id]);
                                        })->first();
            return $query['_matchingData']['AssocCompaniesMembers']['accessLevel'];
        }else{
            return 0;
        }
    }
    /*
    public function getMemberAccessByCompany($member_id, $company_id) {
        $companiesTable = TableRegistry::get('Companies');
        $query = $companiesTable->find()->hydrate(false)->contain(['Members'])->where(['companies.id' => $company_id])
                    ->matching('Members', function ($q) use($member_id) {
                                            return $q->where(['Members.id' => $member_id]);
                                        })->first();
        return $query['_matchingData']['AssocCompaniesMembers']['accessLevel'];
    }
    */
    public function isCompanyManager($user_id, $company_id, $type) {
        $companiesTable = TableRegistry::get('Companies');
        if($type === 'user'){    
            $query = $companiesTable->find()->hydrate(false)->contain(['Users'])->where(['Companies.id' => $company_id])
                        ->matching('Users', function ($q) use($user_id) {
                                                return $q->where(['Users.id' => $user_id]);
                                            })->first();
            if($query['_matchingData']['AssocCompaniesUsers']['accessLevel'] == 5){
                return true;
            }
            //return $query['_matchingData']['AssocCompaniesUsers']['companyManager'];
        }elseif($type === 'member'){
            $query = $companiesTable->find()->hydrate(false)->contain(['Members'])->where(['Companies.id' => $company_id])
                        ->matching('Members', function ($q) use($user_id) {
                                                return $q->where(['Members.id' => $user_id]);
                                            })->first();
            if($query['_matchingData']['AssocCompaniesMembers']['accessLevel'] == 5){
                return true;
            }
        }
        return false;
    }
    
    public function heIsACompanyManager($user_id, $type) {
        $companiesTable = TableRegistry::get('Companies');
        if($type === 'user'){    
            $query = $companiesTable->find()->hydrate(false)->contain(['Users'])
                        ->matching('Users', function ($q) use($user_id) {
                                                return $q->where(['Users.id' => $user_id, 'AssocCompaniesUsers.accessLevel' => 5]);
                                            });
            if($query->count() > 0) {
                return true;
            }
        }elseif($type === 'member'){
            $query = $companiesTable->find()->hydrate(false)->contain(['Members'])
                        ->matching('Members', function ($q) use($user_id) {
                                                return $q->where(['Members.id' => $user_id, 'AssocCompaniesMembers.accessLevel' => 5]);
                                            })->first();
            if($query->count() > 0) {
                return true;
            }
        }
        return false;
    }
}
