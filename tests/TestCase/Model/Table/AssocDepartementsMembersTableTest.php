<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\AssocDepartementsMembersTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\AssocDepartementsMembersTable Test Case
 */
class AssocDepartementsMembersTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\AssocDepartementsMembersTable
     */
    public $AssocDepartementsMembers;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.assoc_departements_members',
        'app.departements',
        'app.companies',
        'app.assoc_companies_members',
        'app.members',
        'app.authentifications',
        'app.users',
        'app.teams',
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
        'app.assoc_teams_users',
        'app.assoc_teams_criterions',
        'app.actiondisciplinaires',
        'app.assoc_users_actiondisciplinaires',
        'app.rapports',
        'app.user_urls',
        'app.assoc_companies_users',
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
        $config = TableRegistry::exists('AssocDepartementsMembers') ? [] : ['className' => 'App\Model\Table\AssocDepartementsMembersTable'];
        $this->AssocDepartementsMembers = TableRegistry::get('AssocDepartementsMembers', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->AssocDepartementsMembers);

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
