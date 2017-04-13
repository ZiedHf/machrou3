<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * AssocUsersActiondisciplinairesFixture
 *
 */
class AssocUsersActiondisciplinairesFixture extends TestFixture
{

    /**
     * Table name
     *
     * @var string
     */
    public $table = 'assoc_users_actiondisciplinaires';

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'action_disciplinaire_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'user_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        '_indexes' => [
            'FK_assocRA_action_disciplinaire_idx' => ['type' => 'index', 'columns' => ['action_disciplinaire_id'], 'length' => []],
            'FK_assocRA_ressources_idx' => ['type' => 'index', 'columns' => ['user_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'FK_assocRA_actionDisciplinaire' => ['type' => 'foreign', 'columns' => ['action_disciplinaire_id'], 'references' => ['actiondisciplinaires', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'FK_assocRA_ressources' => ['type' => 'foreign', 'columns' => ['user_id'], 'references' => ['users', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
        ],
        '_options' => [
            'engine' => 'InnoDB',
            'collation' => 'utf8_unicode_ci'
        ],
    ];
    // @codingStandardsIgnoreEnd

    /**
     * Records
     *
     * @var array
     */
    public $records = [
        [
            'id' => 1,
            'action_disciplinaire_id' => 1,
            'user_id' => 1
        ],
    ];
}
