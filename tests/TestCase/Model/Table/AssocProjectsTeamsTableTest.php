<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\AssocProjectsTeamsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\AssocProjectsTeamsTable Test Case
 */
class AssocProjectsTeamsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\AssocProjectsTeamsTable
     */
    public $AssocProjectsTeams;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.assoc_projects_teams',
        'app.projects',
        'app.assoc_users_projects',
        'app.users',
        'app.assoc_teams_users',
        'app.assoc_users_actiondisciplinaires',
        'app.rapports',
        'app.teams',
        'app.departements'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('AssocProjectsTeams') ? [] : ['className' => 'App\Model\Table\AssocProjectsTeamsTable'];
        $this->AssocProjectsTeams = TableRegistry::get('AssocProjectsTeams', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->AssocProjectsTeams);

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
