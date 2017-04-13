<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\AssocMembersProjectsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\AssocMembersProjectsTable Test Case
 */
class AssocMembersProjectsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\AssocMembersProjectsTable
     */
    public $AssocMembersProjects;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.assoc_members_projects',
        'app.members',
        'app.authentifications',
        'app.users',
        'app.teams',
        'app.departements',
        'app.companies',
        'app.assoc_companies_members',
        'app.assoc_companies_users',
        'app.criterions',
        'app.projects',
        'app.assoc_projects_teams',
        'app.assoc_users_projects',
        'app.clients',
        'app.assoc_clients_projects',
        'app.assoc_projects_criterions',
        'app.priorities',
        'app.project_stages',
        'app.project_urls',
        'app.assoc_users_criterions',
        'app.assoc_departements_criterions',
        'app.assoc_teams_users',
        'app.assoc_teams_criterions',
        'app.actiondisciplinaires',
        'app.assoc_users_actiondisciplinaires',
        'app.rapports',
        'app.user_urls'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('AssocMembersProjects') ? [] : ['className' => 'App\Model\Table\AssocMembersProjectsTable'];
        $this->AssocMembersProjects = TableRegistry::get('AssocMembersProjects', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->AssocMembersProjects);

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
