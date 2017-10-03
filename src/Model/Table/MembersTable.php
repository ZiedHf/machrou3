<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\ORM\TableRegistry;

/**
 * Members Model
 *
 * @property \Cake\ORM\Association\HasMany $Authentifications
 *
 * @method \App\Model\Entity\Member get($primaryKey, $options = [])
 * @method \App\Model\Entity\Member newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Member[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Member|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Member patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Member[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Member findOrCreate($search, callable $callback = null)
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class MembersTable extends Table
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

        $this->table('members');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasOne('Authentifications', [
            'foreignKey' => 'member_id'
        ]);

        $this->belongsToMany('Companies', [
            'joinTable' => 'assoc_companies_members',
            'through' => 'AssocCompaniesMembers'
        ]);

        $this->belongsToMany('Departements', [
            'joinTable' => 'assoc_departements_members',
            'through' => 'AssocDepartementsMembers'
        ]);

        $this->belongsToMany('Teams', [
            'joinTable' => 'assoc_teams_members',
        ]);

        $this->belongsToMany('Projects', [
            'joinTable' => 'assoc_projects_members',
            'through' => 'AssocMembersProjects'
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
            ->allowEmpty('name');

        $validator
            ->allowEmpty('lastName');

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

    public function getMemberDataById($id) {
        $users = TableRegistry::get('Members');
        $result = $users->find('all')->contain(['Authentifications'])->where(['Members.id' => $id])->order(['name' => 'ASC'])->first();
        return $result;
    }
}
