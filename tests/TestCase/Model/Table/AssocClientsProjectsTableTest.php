<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\AssocClientsProjectsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\AssocClientsProjectsTable Test Case
 */
class AssocClientsProjectsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\AssocClientsProjectsTable
     */
    public $AssocClientsProjects;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.assoc_clients_projects',
        'app.clients',
        'app.projects',
        'app.teams',
        'app.departements',
        'app.companies',
        'app.members',
        'app.authentifications',
        'app.users',
        'app.assoc_teams_users',
        'app.actiondisciplinaires',
        'app.assoc_users_actiondisciplinaires',
        'app.assoc_users_projects',
        'app.assoc_companies_users',
        'app.assoc_departements_users',
        'app.rapports',
        'app.criterions',
        'app.assoc_projects_criterions',
        'app.assoc_users_criterions',
        'app.user_urls',
        'app.assoc_companies_members',
        'app.assoc_departements_members',
        'app.assoc_teams_members',
        'app.assoc_projects_members',
        'app.assoc_departements_criterions',
        'app.assoc_projects_teams',
        'app.assoc_teams_criterions',
        'app.priorities',
        'app.project_stages',
        'app.project_urls'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('AssocClientsProjects') ? [] : ['className' => 'App\Model\Table\AssocClientsProjectsTable'];
        $this->AssocClientsProjects = TableRegistry::get('AssocClientsProjects', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->AssocClientsProjects);

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
