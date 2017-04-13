<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\ORM\TableRegistry;

/**
 * AssocCompaniesUsers Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Users
 * @property \Cake\ORM\Association\BelongsTo $Companies
 *
 * @method \App\Model\Entity\AssocCompaniesUser get($primaryKey, $options = [])
 * @method \App\Model\Entity\AssocCompaniesUser newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\AssocCompaniesUser[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\AssocCompaniesUser|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\AssocCompaniesUser patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\AssocCompaniesUser[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\AssocCompaniesUser findOrCreate($search, callable $callback = null)
 */
class AssocCompaniesUsersTable extends Table
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

        $this->table('assoc_companies_users');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Companies', [
            'foreignKey' => 'company_id',
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

        $validator
            ->integer('companyManager')
            ->allowEmpty('companyManager');

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
        $rules->add($rules->existsIn(['company_id'], 'Companies'));
        $rules->add($rules->isUnique(
            ['user_id', 'company_id'],
            'This user & company combination has already been used.'
        ));
        return $rules;
    }
    /*
    public function getUserAccessByCompany($user_id, $company_id) {
        $assocCompUsers = TableRegistry::get('AssocCompaniesUsers');
        $result = $assocCompUsers->find('all')->where(['user_id' => $user_id, 'company_id' => $company_id])->first();
        debug($result);die();
        return $result['accessLevel'];
    }*/
     
    
}
