<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ProjectUrlsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ProjectUrlsTable Test Case
 */
class ProjectUrlsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ProjectUrlsTable
     */
    public $ProjectUrls;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.project_urls',
        'app.projects',
        'app.teams',
        'app.departements',
        'app.criterions',
        'app.assoc_projects_criterions',
        'app.users',
        'app.assoc_teams_users',
        'app.actiondisciplinaires',
        'app.assoc_users_actiondisciplinaires',
        'app.assoc_users_projects',
        'app.rapports',
        'app.assoc_users_criterions',
        'app.assoc_departements_criterions',
        'app.assoc_projects_teams',
        'app.assoc_teams_criterions',
        'app.clients',
        'app.assoc_clients_projects',
        'app.priorities',
        'app.project_stages'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('ProjectUrls') ? [] : ['className' => 'App\Model\Table\ProjectUrlsTable'];
        $this->ProjectUrls = TableRegistry::get('ProjectUrls', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ProjectUrls);

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
