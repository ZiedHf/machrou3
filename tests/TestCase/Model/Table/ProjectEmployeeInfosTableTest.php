<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ProjectEmployeeInfosTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ProjectEmployeeInfosTable Test Case
 */
class ProjectEmployeeInfosTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ProjectEmployeeInfosTable
     */
    public $ProjectEmployeeInfos;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.project_employee_infos',
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
        $config = TableRegistry::exists('ProjectEmployeeInfos') ? [] : ['className' => 'App\Model\Table\ProjectEmployeeInfosTable'];
        $this->ProjectEmployeeInfos = TableRegistry::get('ProjectEmployeeInfos', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ProjectEmployeeInfos);

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
