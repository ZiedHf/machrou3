<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\AssocDepartementsUsersTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\AssocDepartementsUsersTable Test Case
 */
class AssocDepartementsUsersTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\AssocDepartementsUsersTable
     */
    public $AssocDepartementsUsers;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.assoc_departements_users',
        'app.departements',
        'app.companies',
        'app.assoc_companies_members',
        'app.assoc_companies_users',
        'app.teams',
        'app.projects',
        'app.assoc_projects_teams',
        'app.users',
        'app.assoc_teams_users',
        'app.actiondisciplinaires',
        'app.assoc_users_actiondisciplinaires',
        'app.assoc_users_projects',
        'app.rapports',
        'app.criterions',
        'app.assoc_projects_criterions',
        'app.assoc_users_criterions',
        'app.authentifications',
        'app.clients',
        'app.assoc_clients_projects',
        'app.members',
        'app.user_urls',
        'app.priorities',
        'app.project_stages',
        'app.project_urls',
        'app.assoc_teams_criterions',
        'app.assoc_departements_criterions'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('AssocDepartementsUsers') ? [] : ['className' => 'App\Model\Table\AssocDepartementsUsersTable'];
        $this->AssocDepartementsUsers = TableRegistry::get('AssocDepartementsUsers', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->AssocDepartementsUsers);

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
