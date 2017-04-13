<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ProjectClientInfosTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ProjectClientInfosTable Test Case
 */
class ProjectClientInfosTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ProjectClientInfosTable
     */
    public $ProjectClientInfos;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.project_client_infos',
        'app.assoc_users_projects',
        'app.users',
        'app.teams',
        'app.departements',
        'app.projects',
        'app.assoc_projects_teams',
        'app.assoc_teams_users',
        'app.actiondisciplinaires',
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
        $config = TableRegistry::exists('ProjectClientInfos') ? [] : ['className' => 'App\Model\Table\ProjectClientInfosTable'];
        $this->ProjectClientInfos = TableRegistry::get('ProjectClientInfos', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ProjectClientInfos);

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
