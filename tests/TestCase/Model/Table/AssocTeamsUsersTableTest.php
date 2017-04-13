<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\AssocTeamsUsersTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\AssocTeamsUsersTable Test Case
 */
class AssocTeamsUsersTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\AssocTeamsUsersTable
     */
    public $AssocTeamsUsers;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.assoc_teams_users',
        'app.teams',
        'app.departements',
        'app.assoc_projects_teams',
        'app.projects',
        'app.assoc_users_projects',
        'app.users',
        'app.assoc_users_actiondisciplinaires',
        'app.rapports'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('AssocTeamsUsers') ? [] : ['className' => 'App\Model\Table\AssocTeamsUsersTable'];
        $this->AssocTeamsUsers = TableRegistry::get('AssocTeamsUsers', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->AssocTeamsUsers);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
