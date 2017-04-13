<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\AssocTeamsMembersTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\AssocTeamsMembersTable Test Case
 */
class AssocTeamsMembersTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\AssocTeamsMembersTable
     */
    public $AssocTeamsMembers;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.assoc_teams_members',
        'app.teams',
        'app.departements',
        'app.companies',
        'app.assoc_companies_members',
        'app.members',
        'app.authentifications',
        'app.users',
        'app.assoc_teams_users',
        'app.actiondisciplinaires',
        'app.assoc_users_actiondisciplinaires',
        'app.projects',
        'app.assoc_projects_teams',
        'app.assoc_users_projects',
        'app.clients',
        'app.assoc_clients_projects',
        'app.criterions',
        'app.assoc_projects_criterions',
        'app.assoc_users_criterions',
        'app.priorities',
        'app.project_stages',
        'app.project_urls',
        'app.rapports',
        'app.user_urls',
        'app.assoc_companies_users',
        'app.assoc_departements_criterions',
        'app.assoc_teams_criterions'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('AssocTeamsMembers') ? [] : ['className' => 'App\Model\Table\AssocTeamsMembersTable'];
        $this->AssocTeamsMembers = TableRegistry::get('AssocTeamsMembers', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->AssocTeamsMembers);

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
