<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * AssocUsersActiondisciplinaires Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Actiondisciplinaires
 * @property \Cake\ORM\Association\BelongsTo $Users
 *
 * @method \App\Model\Entity\AssocUsersActiondisciplinaires get($primaryKey, $options = [])
 * @method \App\Model\Entity\AssocUsersActiondisciplinaires newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\AssocUsersActiondisciplinaires[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\AssocUsersActiondisciplinaires|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\AssocUsersActiondisciplinaires patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\AssocUsersActiondisciplinaires[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\AssocUsersActiondisciplinaires findOrCreate($search, callable $callback = null)
 */
class AssocUsersActiondisciplinairesTable extends Table
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

        $this->table('assoc_users_actiondisciplinaires');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('Actiondisciplinaires', [
            'foreignKey' => 'action_disciplinaire_id',
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
        $rules->add($rules->existsIn(['action_disciplinaire_id'], 'Actiondisciplinaires'));
        $rules->add($rules->existsIn(['user_id'], 'Users'));

        return $rules;
    }
}
