<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\AssocUsersProjectsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\AssocUsersProjectsTable Test Case
 */
class AssocUsersProjectsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\AssocUsersProjectsTable
     */
    public $AssocUsersProjects;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.assoc_users_projects',
        'app.users',
        'app.assoc_teams_users',
        'app.assoc_users_actiondisciplinaires',
        'app.rapports',
        'app.projects',
        'app.assoc_projects_teams'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('AssocUsersProjects') ? [] : ['className' => 'App\Model\Table\AssocUsersProjectsTable'];
        $this->AssocUsersProjects = TableRegistry::get('AssocUsersProjects', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->AssocUsersProjects);

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
