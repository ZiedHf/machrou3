<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\ORM\TableRegistry;

/**
 * Projects Model
 *
 * @property \Cake\ORM\Association\HasMany $AssocProjectsTeams
 * @property \Cake\ORM\Association\HasMany $AssocUsersProjects
 *
 * @method \App\Model\Entity\Project get($primaryKey, $options = [])
 * @method \App\Model\Entity\Project newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Project[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Project|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Project patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Project[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Project findOrCreate($search, callable $callback = null)
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ProjectsTable extends Table
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

        $this->table('projects');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        /*$this->hasMany('AssocProjectsTeams', [
            'foreignKey' => 'project_id'
        ]);*/
        $this->belongsToMany('Teams', [
            'joinTable' => 'assoc_projects_teams',
        ]);
        /*$this->hasMany('AssocUsersProjects', [
            'foreignKey' => 'project_id'
        ]);*/
        $this->belongsToMany('Users', [
            'joinTable' => 'assoc_users_projects',
            'through' => 'AssocUsersProjects'
        ]);

        $this->belongsToMany('Members', [
            'joinTable' => 'assoc_members_projects',
            'through' => 'AssocMembersProjects'
        ]);

        $this->belongsToMany('Clients', [
            'joinTable' => 'assoc_clients_projects',
        ]);

        $this->belongsToMany('Criterions', [
            'joinTable' => 'assoc_projects_criterions',
        ]);

        $this->belongsTo('Priorities', [
            'foreignKey' => 'priority_id'
        ]);

        $this->belongsTo('ProjectStages', [
            'foreignKey' => 'project_stage_id'
        ]);

        $this->hasMany('ProjectUrls', [
            'className' => 'ProjectUrls'
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
            ])
            ->add('q2', 'Search.Compare', [
                'operator' => '<=',
                'field' => ['accomplishment']
            ])
            ->add('q3', 'Search.Compare', [
                'operator' => '>=',
                'field' => ['accomplishment']
            ])
            ->add('project_stage_id', 'Search.Callback', [
                                        'callback' => function ($query, $args, $type) {
                                            return $query
                                                ->matching('ProjectStages', function (Query $query) use ($args) {
                                                    return $query
                                                        ->where([
                                                            $this->ProjectStages->target()->aliasField('id') => $args['project_stage_id']
                                                        ]);
                                                });
                                        }
                                    ])
            ->add('priority_id', 'Search.Callback', [
                                        'callback' => function ($query, $args, $type) {
                                            return $query
                                                ->matching('Priorities', function (Query $query) use ($args) {
                                                    return $query
                                                        ->where([
                                                            $this->Priorities->target()->aliasField('id') => $args['priority_id']
                                                        ]);
                                                });
                                        }
                                    ])
            ->add('user_id', 'Search.Callback', [
                                        'callback' => function ($query, $args, $type) {
                                            return $query
                                                ->matching('Users', function (Query $query) use ($args) {
                                                    return $query
                                                        ->where([
                                                            $this->Users->target()->aliasField('id') => $args['user_id']
                                                        ]);
                                                });
                                        }
                                    ])
            ->add('client_id', 'Search.Callback', [
                                        'callback' => function ($query, $args, $type) {
                                            return $query
                                                ->matching('Clients', function (Query $query) use ($args) {
                                                    return $query
                                                        ->where([
                                                            $this->Clients->target()->aliasField('id') => $args['client_id']
                                                        ]);
                                                });
                                        }
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
            ->numeric('accomplishment')
            ->allowEmpty('accomplishment');

        $validator
            ->allowEmpty('description');

        $validator
            ->allowEmpty('objective');

        $validator
            ->allowEmpty('path_doc');

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

        $validator->dateTime('dateBegin')->allowEmpty('dateBegin');
        $validator->dateTime('dateEnd')->allowEmpty('dateEnd');

        return $validator;
    }
    /*
    public function validationAdd(Validator $validator)
    {
        $validator = $this->validationDefault($validator);
        return $validator;
    }*/

    public function getProjectsList() {
        $projects = TableRegistry::get('Projects');
        $result = $projects->find('list')->order(['name' => 'ASC'])->toArray();
        return $result;
    }

    public function getAllProjectData($stage_id = null){
        $projects = TableRegistry::get('Projects');
        //$results = $projects->find('all')->contain(['Users', 'Clients', 'Teams', 'Teams.Users','Teams.Departements'])->order(['name' => 'ASC'])->toArray();
        if($stage_id === null){

            $results = $projects->find('all')->contain(['Users' => ['queryBuilder' => function ($q) {
                                                            return $q->where(['AssocUsersProjects.accessLevel >' => '1']);
                                                        }],
                                                    'Clients',
                                                    'Teams' => ['sort' => ['Teams.name' => 'ASC']],
                                                    'Teams.Users',
                                                    'Teams.Departements'  => ['sort' => ['Departements.name' => 'ASC']],
                                                    'Priorities',
                                                    'ProjectStages'
                                                    ])->order(['Projects.name' => 'ASC'])->toArray();
        }else{
            $results = $projects->find('all')->contain(['Users',
                                                    'Clients',
                                                    'Teams' => ['sort' => ['Teams.name' => 'ASC']],
                                                    'Teams.Users',
                                                    'Teams.Departements'  => ['sort' => ['Departements.name' => 'ASC']],
                                                    'Priorities',
                                                    'ProjectStages'
                                                    ])->where(['Projects.project_stage_id' => $stage_id])->order(['Projects.name' => 'ASC'])->toArray();
        }

        foreach ($results as $keyProject => $project){
            $arrayDep = array();
            foreach ($project->teams as $keyTeam => $team){ // Récuperer le departement (important pour l'utiliser dans la page home)
                if(!(in_array($team->departement_id, $arrayDep)))
                    $arrayDep[] = $team->departement_id;
                //debug($team->departement_id); die();
            }
            $results[$keyProject]['departement'] = $arrayDep;
            /*
            //scan directory and get all files
            if($project->path_dir !== null){
                $allFiles = scandir(PROJECTS_UPLOAD.DS.$project->path_dir);
                $results[$keyProject]['files'] = array_diff($allFiles, array('.', '..')); // les noms des dossiers seulement
            }*/
        }

        return $results;
    }

    public function getAllProjectDataByUser($stage_id = null, $user_type = null, $user_id = null, $group_manager = null){
        if($group_manager){
            return $this->getAllProjectData($stage_id);
        }

        $projects = TableRegistry::get('Projects');
        $entity = null;
        if($user_type == 'user'){
            $entity = 'Users';
        }elseif($user_type == 'member'){
            $entity = 'Members';
        }

        //Les projets sur les quels ce user a l'access selon la societe
        $results_ProjectsCompManager = $projects->find()
                                ->innerJoinWith("Teams.Departements.Companies.$entity", function ($q) use ($user_id, $entity) {
                                        return $q->where(["$entity.id" => $user_id, "AssocCompanies$entity.accessLevel >" => 0]);
                                    })->contain(['Users' => ['queryBuilder' => function ($q) {
                                                        return $q->where(['AssocUsersProjects.accessLevel >' => '1']);
                                                    }],
                                                'Clients',
                                                'Teams' => ['sort' => ['Teams.name' => 'ASC']],
                                                'Teams.Users',
                                                'Teams.Departements'  => ['sort' => ['Departements.name' => 'ASC']],
                                                'Priorities',
                                                'ProjectStages'
                                                ]);
        //Filtre selon le stage s'il existe
        ($stage_id !== null) ? $results_ProjectsCompManager->where(['Projects.project_stage_id' => $stage_id])
                                                ->order(['Projects.name' => 'ASC'])
                            : $results_ProjectsCompManager->order(['Projects.name' => 'ASC']);
                        //debug($results_ProjectsCompManager->toArray()); die();
        //Les projets sur les quels ce user a l'access selon la dep
        $results_ProjectsDepManager = $projects->find()
                                ->innerJoinWith("Teams.Departements.$entity", function ($q) use ($user_id, $entity) {
                                        return $q->where(["$entity.id" => $user_id, "AssocDepartements$entity.accessLevel >" => 0]);
                                    })->contain(['Users' => ['queryBuilder' => function ($q) {
                                                        return $q->where(['AssocUsersProjects.accessLevel >' => '1']);
                                                    }],
                                                'Clients',
                                                'Teams' => ['sort' => ['Teams.name' => 'ASC']],
                                                'Teams.Users',
                                                'Teams.Departements'  => ['sort' => ['Departements.name' => 'ASC']],
                                                'Priorities',
                                                'ProjectStages'
                                                ]);
        //Filtre selon le stage s'il existe
        ($stage_id !== null) ? $results_ProjectsDepManager->where(['Projects.project_stage_id' => $stage_id])
                                                ->order(['Projects.name' => 'ASC'])
                            : $results_ProjectsDepManager->order(['Projects.name' => 'ASC']);
        //Les projets sur les quels ce user a l'access selon la Team
        $results_ProjectsTeamsManager = $projects->find()
                                ->innerJoinWith("Teams.$entity", function ($q) use ($user_id, $entity) {
                                        return $q->where(["$entity.id" => $user_id, "AssocTeams$entity.accessLevel >" => 3]);
                                    })->contain(['Users' => ['queryBuilder' => function ($q) {
                                                        return $q->where(['AssocUsersProjects.accessLevel >' => '1']);
                                                    }],
                                                'Clients',
                                                'Teams' => ['sort' => ['Teams.name' => 'ASC']],
                                                'Teams.Users',
                                                'Teams.Departements'  => ['sort' => ['Departements.name' => 'ASC']],
                                                'Priorities',
                                                'ProjectStages'
                                                ]);
        //Filtre selon le stage s'il existe
        ($stage_id !== null) ? $results_ProjectsTeamsManager->where(['Projects.project_stage_id' => $stage_id])
                                                ->order(['Projects.name' => 'ASC'])
                            : $results_ProjectsTeamsManager->order(['Projects.name' => 'ASC']);
        //Ses projets
        $results_HisProjects = $projects->find()
                                ->innerJoinWith("$entity", function ($q) use ($user_id, $entity) {
                                        $table = ($entity == 'Users') ? 'AssocUsersProjects' : 'AssocMembersProjects';
                                        return $q->where(["$entity.id" => $user_id, "$table.accessLevel >" => 0]);
                                    })->contain(['Users' => ['queryBuilder' => function ($q) {
                                                        return $q->where(['AssocUsersProjects.accessLevel >' => '1']);
                                                    }],
                                                'Clients',
                                                'Teams' => ['sort' => ['Teams.name' => 'ASC']],
                                                'Teams.Users',
                                                'Teams.Departements'  => ['sort' => ['Departements.name' => 'ASC']],
                                                'Priorities',
                                                'ProjectStages'
                                                ]);
        //Filtre selon le stage s'il existe
        ($stage_id !== null) ? $results_HisProjects->where(['Projects.project_stage_id' => $stage_id])
                                                ->order(['Projects.name' => 'ASC'])
                            : $results_HisProjects->order(['Projects.name' => 'ASC']);

        $results = $results_ProjectsCompManager->union($results_ProjectsDepManager);
        $results->union($results_ProjectsTeamsManager);
        $results->union($results_HisProjects);
        //debug($results->toArray()); die();
        $results = $results->epilog('ORDER BY Projects__name ASC')->toArray();

        foreach ($results as $keyProject => $project){
            $arrayDep = array();
            foreach ($project->teams as $keyTeam => $team){ // Récuperer le departement (important pour l'utiliser dans la page home)
                if(!(in_array($team->departement_id, $arrayDep)))
                    $arrayDep[] = $team->departement_id;
                //debug($team->departement_id); die();
            }
            $results[$keyProject]['departement'] = $arrayDep;
            /*
            //scan directory and get all files
            if($project->path_dir !== null){
                $allFiles = scandir(PROJECTS_UPLOAD.DS.$project->path_dir);
                $results[$keyProject]['files'] = array_diff($allFiles, array('.', '..')); // les noms des dossiers seulement
            }*/
        }

        return $results;
    }

    //
    public function getLastProjectsData($num){ //getProjectsData limit $num
        $projects = TableRegistry::get('Projects');

        $results = $projects->find('all')->contain(['Users' => ['queryBuilder' => function ($q) {
                                                            return $q->where(['AssocUsersProjects.accessLevel >' => '1']);
                                                        }], 'Clients', 'Teams', 'Teams.Users','Teams.Departements', 'Priorities', 'ProjectStages'])->order(['created' => 'DESC'])->limit($num)->toArray();

        foreach ($results as $keyProject => $project){
            $arrayDep = array();
            foreach ($project->teams as $keyTeam => $team){ // Récuperer le departement (important pour l'utiliser dans la page home)
                if(!(in_array($team->departement_id, $arrayDep)))
                    $arrayDep[] = $team->departement_id;
            }
            $results[$keyProject]['departement'] = $arrayDep;
        }

        return $results;
    }

    public function getLastProjectsDataByUser($num, $user_type, $user_id, $group_manager){ //getProjectsData limit $num
        if($group_manager){
            return $this->getLastProjectsData($num);
        }

        $entity = ($user_type == 'user') ? 'Users' : 'Members';

        $projects = TableRegistry::get('Projects');
        /*
        $results = $projects->find('all')->contain(['Users' => ['queryBuilder' => function ($q) {
                                                            return $q->where(['AssocUsersProjects.accessLevel >' => '1']);
                                                        }], 'Clients', 'Teams', 'Teams.Users','Teams.Departements', 'Priorities', 'ProjectStages'])->order(['created' => 'DESC'])->limit($num)->toArray();
        */
        $results_ProjectsCompManager = $projects->find()
                                ->innerJoinWith("Teams.Departements.Companies.$entity", function ($q) use ($user_id, $entity) {
                                        return $q->where(["$entity.id" => $user_id, "AssocCompanies$entity.accessLevel >" => 0]);
                                    })->contain(['Users' => ['queryBuilder' => function ($q) {
                                                            return $q->where(['AssocUsersProjects.accessLevel >' => '1']);
                                                        }], 'Clients', 'Teams', 'Teams.Users','Teams.Departements', 'Priorities', 'ProjectStages']);

        //Les projets sur les quels ce user a l'access selon la dep
        $results_ProjectsDepManager = $projects->find()
                                ->innerJoinWith("Teams.Departements.$entity", function ($q) use ($user_id, $entity) {
                                        return $q->where(["$entity.id" => $user_id, "AssocDepartements$entity.accessLevel >" => 0]);
                                    })->contain(['Users' => ['queryBuilder' => function ($q) {
                                                            return $q->where(['AssocUsersProjects.accessLevel >' => '1']);
                                                        }], 'Clients', 'Teams', 'Teams.Users','Teams.Departements', 'Priorities', 'ProjectStages']);

        //Les projets sur les quels ce user a l'access selon la Team
        $results_ProjectsTeamsManager = $projects->find()
                                ->innerJoinWith("Teams.$entity", function ($q) use ($user_id, $entity) {
                                        return $q->where(["$entity.id" => $user_id, "AssocTeams$entity.accessLevel >" => 3]);
                                    })->contain(['Users' => ['queryBuilder' => function ($q) {
                                                            return $q->where(['AssocUsersProjects.accessLevel >' => '1']);
                                                        }], 'Clients', 'Teams', 'Teams.Users','Teams.Departements', 'Priorities', 'ProjectStages']);

        //Ses projets
        $results_HisProjects = $projects->find()
                                ->innerJoinWith("$entity", function ($q) use ($user_id, $entity) {
                                        $table = ($entity == 'Users') ? 'AssocUsersProjects' : 'AssocMembersProjects';
                                        return $q->where(["$entity.id" => $user_id, "$table.accessLevel >" => 0]);
                                    })->contain(['Users' => ['queryBuilder' => function ($q) {
                                                            return $q->where(['AssocUsersProjects.accessLevel >' => '1']);
                                                        }], 'Clients', 'Teams', 'Teams.Users','Teams.Departements', 'Priorities', 'ProjectStages']);

        $results = $results_ProjectsCompManager->union($results_ProjectsDepManager);
        $results->union($results_ProjectsTeamsManager);
        $results->union($results_HisProjects);
        //debug($results->toArray()); die();
        $results = $results->epilog("ORDER BY Projects__id DESC LIMIT $num")->toArray();
        /*
        $results = $projects->find('all')->contain(['Users' => ['queryBuilder' => function ($q) {
                                                            return $q->where(['AssocUsersProjects.accessLevel >' => '1']);
                                                        }], 'Clients', 'Teams', 'Teams.Users','Teams.Departements', 'Priorities', 'ProjectStages'])->order(['created' => 'DESC'])->limit($num)->toArray();
        */
        foreach ($results as $keyProject => $project){
            $arrayDep = array();
            foreach ($project->teams as $keyTeam => $team){ // Récuperer le departement (important pour l'utiliser dans la page home)
                if(!(in_array($team->departement_id, $arrayDep)))
                    $arrayDep[] = $team->departement_id;
            }
            $results[$keyProject]['departement'] = $arrayDep;
        }

        return $results;
    }

    public function getAllProjectDataByDep($dep_id){
        $projects = TableRegistry::get('Projects');
        /*$results = $projects->find('all')->contain(['Users', 'Teams'  => function ($q) {
                                                                                        return $q->where(['Teams.departement_id' => 4]);
                                                                                     }, 'Teams.Users','Teams.Departements'])->toArray();*/
        $results = $projects->find('all')->contain(['Users' => ['queryBuilder' => function ($q) {
                                                            return $q->where(['AssocUsersProjects.accessLevel >' => '1']);
                                                        }], 'Teams', 'Teams.Users','Teams.Departements', 'Priorities', 'ProjectStages']);
        $results = $results->matching('Teams', function ($q) use ($dep_id) {
            return $q->where(['Teams.departement_id' => $dep_id]);
        })->toArray();

        foreach ($results as $keyProject => $project){
            $arrayDep = array();
            foreach ($project->teams as $keyTeam => $team){ // Récuperer le departement (important pour l'utiliser dans la page home)
                if(!(in_array($team->departement_id, $arrayDep)))
                    $arrayDep[] = $team->departement_id;
                //debug($team->departement_id); die();
            }
            $results[$keyProject]['departement'] = $arrayDep;
            /*
            //scan directory and get all files
            if($project->path_dir !== null){
                $allFiles = scandir(PROJECTS_UPLOAD.DS.$project->path_dir);
                $results[$keyProject]['files'] = array_diff($allFiles, array('.', '..')); // les noms des dossiers seulement
            }*/
        }

        return $results;
    }

    public function getAllProjectDataById($id){
        $projects = TableRegistry::get('Projects');
        $results = $projects->find('all')->contain(['Users' => [
                                                        //'strategy' => 'select',
                                                        'queryBuilder' => function ($q) {
                                                            return $q->where(['AssocUsersProjects.accessLevel >' => '1'])->order(['Users.name' =>'ASC']);
                                                        }
                                                    ], 'Clients' => [
                                                        //'strategy' => 'select',
                                                        'queryBuilder' => function ($q) {
                                                            return $q->order(['Clients.name' =>'ASC']);
                                                        }
                                                    ], 'Teams'  => [
                                                        //'strategy' => 'select',
                                                        'queryBuilder' => function ($q) {
                                                            return $q->order(['Teams.name' =>'ASC']);
                                                        }
                                                    ], 'Teams.Users'  => [
                                                        //'strategy' => 'select',
                                                        'queryBuilder' => function ($q) {
                                                            return $q->order(['Users.name' =>'ASC']);
                                                        }, 'Teams'
                                                    ],'Teams.Departements'
                                                    , 'ProjectStages' => [
                                                        //'strategy' => 'select',
                                                        'queryBuilder' => function ($q) {
                                                            return $q->order(['ProjectStages.name' =>'ASC']);
                                                        }
                                                    ]
                                                    , 'Priorities'
                                                    , 'Criterions'  => [
                                                        //'strategy' => 'select',
                                                        'queryBuilder' => function ($q) {
                                                            return $q->order(['Criterions.name' =>'ASC']);
                                                        }
                                                    ]
                                                    , 'ProjectUrls'  => [
                                                        //'strategy' => 'select',
                                                        'queryBuilder' => function ($q) {
                                                            return $q->order(['ProjectUrls.name' =>'ASC']);
                                                        }
                                                    ]])
                ->where(['Projects.id' => $id])->toArray();

        foreach ($results as $keyProject => $project){
            $arrayDep = array();
            foreach ($project->teams as $keyTeam => $team){ // Récuperer le departement (important pour l'utiliser dans la page home)
                if(!(in_array($team->departement_id, $arrayDep)))
                    $arrayDep[] = $team->departement_id;
                //debug($team->departement_id); die();
            }
            $results[$keyProject]['departement'] = $arrayDep;

            //scan directory and get all files
            if($project->path_dir !== null){
                $allFiles = scandir(PROJECTS_UPLOAD.DS.$project->path_dir);
                $results[$keyProject]['files'] = array_diff($allFiles, array('.', '..')); // les noms des dossiers seulement
            }
        }

        return $results[0];
    }
    /*public function getProjectDataById($id) {
        $projects = TableRegistry::get('Projects');
        $project = $projects->find('all')->contain(['Teams', 'Users' => ['queryBuilder' => function ($q) {
                                                            return $q->where(['AssocUsersProjects.accessLevel >' =>'2']);
                                                        }], 'Clients', 'Priorities', 'ProjectStages', 'Criterions', 'ProjectUrls'])->toArray();
        debug($project);die();
    }*/
    public function getCountProjects(){
        $projects = TableRegistry::get('Projects');
        $results = $projects->find('list')->count();
        return $results;
    }

    public function getCountProjectsByUser($user_type, $user_id, $group_manager){
        if($group_manager){
            $this->getCountProjects();
        }
        $projects = $this->getAllProjectDataByUser(null, $user_type, $user_id, $group_manager);
        return count($projects);
    }

    public function getFilesByProjects($path_dir) { // Retourner les chemins des fichiers
        if(empty($path_dir)){
            return null;
        }
        $allFiles = scandir(PROJECTS_UPLOAD.DS.$path_dir);
        $files = array_diff($allFiles, array('.', '..')); // les noms des dossiers seulement
        return $files;
    }

    public function calendar_projectsData() {
        $projects = TableRegistry::get('Projects');
        $results = $projects->find('all')->select(['id', 'name', 'dateBegin', 'dateEnd'])->toArray();
        return $results;
    }

    public function isOwnedBy($project_id, $owner_id, $owner_type) {
        if($owner_type === 'client'){
            $assoc = TableRegistry::get('AssocClientsProjects');
            return $assoc->exists(['project_id' => $project_id, 'client_id' => $owner_id]);
        }elseif($owner_type === 'member'){
            $assoc = TableRegistry::get('AssocMembersProjects');
            return $assoc->exists(['project_id' => $project_id, 'member_id' => $owner_id]);
        }elseif($owner_type === 'user'){
            $assoc = TableRegistry::get('AssocUsersProjects');
            return $assoc->exists(['project_id' => $project_id, 'user_id' => $owner_id]);
        }else{
            return false;
        }
    }

    public function getusers_project($project_id) {
        $projectsTable = TableRegistry::get('Projects');
        $result = $projectsTable->find()->hydrate(false)->contain(['Users' => ['queryBuilder' => function ($q) {
                                                            return $q->where(['AssocUsersProjects.accessLevel >' => '1']);
                                                        }]])
                                            ->where(['Projects.id' => $project_id])
                                            ->toArray();

        $users = array();
        foreach($result[0]['users'] as $u => $user) {
            if((!in_array($user['id'], $users))){
                $users[] = $user['id'];
            }
        }
        return $users;
    }

    public function getNotMembersProject($project_id) {
        $projectsTable = TableRegistry::get('Projects');
        $result = $projectsTable->find()->hydrate(false)->contain(['Users' => ['queryBuilder' => function ($q) {
                                                            return $q->where(['AssocUsersProjects.accessLevel <' => '2']);
                                                        }]])
                                            ->where(['Projects.id' => $project_id])
                                            ->toArray();

        $users = array();
        foreach($result[0]['users'] as $u => $user) {
            if((!in_array($user['id'], $users))){
                $users[] = $user['id'];
            }
        }
        return $users;
    }

    public function getProjectManagerByIdProject($id) {
        $assoc = TableRegistry::get('AssocUsersProjects');
        $result = $assoc->find('all')->select('user_id')->where(['project_id' => $id, 'accessLevel' => 5])->first();
        return (!empty($result)) ? $result->user_id : null;
    }

    public function getThisProjectCompaniesId($project_id) {
        $projectsTable = TableRegistry::get('Projects');
        $results = $projectsTable->find()->hydrate(false)->contain(['Teams.Departements'])
                                            ->where(['Projects.id' => $project_id])
                                            ->first();
        $companies_id = array();
        foreach ($results['teams'] as $keyT => $team) {
            $companies_id[] = $team['departement']['company_id'];
        }
        return $companies_id;
    }

    public function getThisProjectDepartementsId($project_id) {
        $projectsTable = TableRegistry::get('Projects');
        $results = $projectsTable->find()->hydrate(false)->contain(['Teams'])
                                            ->where(['Projects.id' => $project_id])
                                            ->first();
        foreach ($results['teams'] as $keyT => $team) {
            $departements_id[] = $team['departement_id'];
        }
        return $departements_id;
    }

    public function getThisProjectTeamsId($project_id) {
        $projectsTable = TableRegistry::get('Projects');
        $results = $projectsTable->find()->hydrate(false)->contain(['Teams'])
                                            ->where(['Projects.id' => $project_id])
                                            ->first();
        foreach ($results['teams'] as $keyT => $team) {
            $teams_id[] = $team['id'];
        }
        return $teams_id;
    }

    public function getUserAccessByProject($user_id, $type, $project_id) {
        $projectsTable = TableRegistry::get('Projects');
        if($type === 'user'){
            $query = $projectsTable->find()->hydrate(false)->contain(['Users'])->where(['Projects.id' => $project_id])
                        ->matching('Users', function ($q) use($user_id) {
                                                return $q->where(['Users.id' => $user_id]);
                                            })->first();
            return $query['_matchingData']['AssocUsersProjects']['accessLevel'];
        }elseif($type === 'member'){
            $query = $projectsTable->find()->hydrate(false)->contain(['Members'])->where(['Projects.id' => $project_id])
                        ->matching('Members', function ($q) use($user_id) {
                                                return $q->where(['Members.id' => $user_id]);
                                            })->first();
            return $query['_matchingData']['AssocMembersProjects']['accessLevel'];
        }else{
            return 0;
        }
    }

    public function getAllProjects_ByUser($user_type, $user_id, $group_manager) {
        if($group_manager){
            return $this->getAllProjects_ByManager();
        }

        $projects = TableRegistry::get('Projects');
        $entity = null;
        if($user_type == 'user'){
            $entity = 'Users';
        }elseif($user_type == 'member'){
            $entity = 'Members';
        }

        //Les projets sur les quels ce user a l'access selon la societe
        $results_ProjectsCompManager = $projects->find()
                                ->innerJoinWith("Teams.Departements.Companies.$entity", function ($q) use ($user_id, $entity) {
                                        return $q->where(["$entity.id" => $user_id, "AssocCompanies$entity.accessLevel >" => 0]);
                                    })->contain(['Users' => ['queryBuilder' => function ($q) {
                                                        return $q->where(['AssocUsersProjects.accessLevel >' => '1']);
                                                    }],
                                                'Clients',
                                                'Teams' => ['sort' => ['Teams.name' => 'ASC']],
                                                'Teams.Users',
                                                'Teams.Departements'  => ['sort' => ['Departements.name' => 'ASC']],
                                                'Priorities',
                                                'ProjectStages'
                                                ]);
                        //debug($results_ProjectsCompManager->toArray()); die();
        //Les projets sur les quels ce user a l'access selon la dep
        $results_ProjectsDepManager = $projects->find()
                                ->innerJoinWith("Teams.Departements.$entity", function ($q) use ($user_id, $entity) {
                                        return $q->where(["$entity.id" => $user_id, "AssocDepartements$entity.accessLevel >" => 0]);
                                    })->contain(['Users' => ['queryBuilder' => function ($q) {
                                                        return $q->where(['AssocUsersProjects.accessLevel >' => '1']);
                                                    }],
                                                'Clients',
                                                'Teams' => ['sort' => ['Teams.name' => 'ASC']],
                                                'Teams.Users',
                                                'Teams.Departements'  => ['sort' => ['Departements.name' => 'ASC']],
                                                'Priorities',
                                                'ProjectStages'
                                                ]);
        //Les projets sur les quels ce user a l'access selon la Team
        $results_ProjectsTeamsManager = $projects->find()
                                ->innerJoinWith("Teams.$entity", function ($q) use ($user_id, $entity) {
                                        return $q->where(["$entity.id" => $user_id, "AssocTeams$entity.accessLevel >" => 3]);
                                    })->contain(['Users' => ['queryBuilder' => function ($q) {
                                                        return $q->where(['AssocUsersProjects.accessLevel >' => '1']);
                                                    }],
                                                'Clients',
                                                'Teams' => ['sort' => ['Teams.name' => 'ASC']],
                                                'Teams.Users',
                                                'Teams.Departements'  => ['sort' => ['Departements.name' => 'ASC']],
                                                'Priorities',
                                                'ProjectStages'
                                                ]);
        //Ses projets
        $results_HisProjects = $projects->find()
                                ->innerJoinWith("$entity", function ($q) use ($user_id, $entity) {
                                        $table = ($entity == 'Users') ? 'AssocUsersProjects' : 'AssocMembersProjects';
                                        return $q->where(["$entity.id" => $user_id, "$table.accessLevel >" => 0]);
                                    })->contain(['Users' => ['queryBuilder' => function ($q) {
                                                        return $q->where(['AssocUsersProjects.accessLevel >' => '1']);
                                                    }],
                                                'Clients',
                                                'Teams' => ['sort' => ['Teams.name' => 'ASC']],
                                                'Teams.Users',
                                                'Teams.Departements'  => ['sort' => ['Departements.name' => 'ASC']],
                                                'Priorities',
                                                'ProjectStages'
                                                ]);

        $results = $results_ProjectsCompManager->union($results_ProjectsDepManager);
        $results->union($results_ProjectsTeamsManager);
        $results->union($results_HisProjects);
        //debug($results->toArray()); die();
        $results = $results->epilog('ORDER BY Projects__name ASC');

        return $results;
    }

    public function getAllProjects_ByManager() {
        $projects = TableRegistry::get('Projects');

        $results = $projects->find('all')->contain(['Users' => ['queryBuilder' => function ($q) {
                                                        return $q->where(['AssocUsersProjects.accessLevel >' => '1']);
                                                    }],
                                                'Clients',
                                                'Teams' => ['sort' => ['Teams.name' => 'ASC']],
                                                'Teams.Users',
                                                'Teams.Departements'  => ['sort' => ['Departements.name' => 'ASC']],
                                                'Priorities',
                                                'ProjectStages'
                                                ])->order(['Projects.name' => 'ASC']);

        return $results;
    }
}
