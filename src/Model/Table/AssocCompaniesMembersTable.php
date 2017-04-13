<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\ORM\TableRegistry;

/**
 * AssocCompaniesMembers Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Members
 * @property \Cake\ORM\Association\BelongsTo $Companies
 *
 * @method \App\Model\Entity\AssocCompaniesMember get($primaryKey, $options = [])
 * @method \App\Model\Entity\AssocCompaniesMember newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\AssocCompaniesMember[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\AssocCompaniesMember|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\AssocCompaniesMember patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\AssocCompaniesMember[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\AssocCompaniesMember findOrCreate($search, callable $callback = null)
 */
class AssocCompaniesMembersTable extends Table
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

        $this->table('assoc_companies_members');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('Members', [
            'foreignKey' => 'member_id',
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
        $rules->add($rules->existsIn(['member_id'], 'Members'));
        $rules->add($rules->existsIn(['company_id'], 'Companies'));
        $rules->add($rules->isUnique(
            ['member_id', 'company_id'],
            'This user & company combination has already been used.'
        ));
        return $rules;
    }
    
    public function getMemberAccessByCompany($member_id, $company_id) {
        $assocCompMembers = TableRegistry::get('AssocCompaniesMembers');
        $result = $assocCompMembers->find('all')->where(['user_id' => $member_id, 'company_id' => $company_id])->first();
        return $result['accessLevel'];
    }
}
