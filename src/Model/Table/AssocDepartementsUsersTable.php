<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * AssocDepartementsUsers Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Departements
 * @property \Cake\ORM\Association\BelongsTo $Users
 *
 * @method \App\Model\Entity\AssocDepartementsUser get($primaryKey, $options = [])
 * @method \App\Model\Entity\AssocDepartementsUser newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\AssocDepartementsUser[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\AssocDepartementsUser|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\AssocDepartementsUser patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\AssocDepartementsUser[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\AssocDepartementsUser findOrCreate($search, callable $callback = null)
 */
class AssocDepartementsUsersTable extends Table
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

        $this->table('assoc_departements_users');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('Departements', [
            'foreignKey' => 'departement_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
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
        $rules->add($rules->existsIn(['user_id'], 'Users'));
        $rules->add($rules->isUnique(
            ['user_id', 'departement_id'],
            'This user & departement combination has already been used.'
        ));
        return $rules;
    }
}
