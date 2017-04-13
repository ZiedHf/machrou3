<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * AssocDepartementsMembers Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Departements
 * @property \Cake\ORM\Association\BelongsTo $Members
 *
 * @method \App\Model\Entity\AssocDepartementsMember get($primaryKey, $options = [])
 * @method \App\Model\Entity\AssocDepartementsMember newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\AssocDepartementsMember[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\AssocDepartementsMember|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\AssocDepartementsMember patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\AssocDepartementsMember[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\AssocDepartementsMember findOrCreate($search, callable $callback = null)
 */
class AssocDepartementsMembersTable extends Table
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

        $this->table('assoc_departements_members');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('Departements', [
            'foreignKey' => 'departement_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Members', [
            'foreignKey' => 'member_id',
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
            ->integer('departementManager')
            ->allowEmpty('departementManager');

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
        $rules->add($rules->existsIn(['member_id'], 'Members'));
        $rules->add($rules->isUnique(
            ['member_id', 'departement_id'],
            'This user & departement combination has already been used.'
        ));
        return $rules;
    }
}
