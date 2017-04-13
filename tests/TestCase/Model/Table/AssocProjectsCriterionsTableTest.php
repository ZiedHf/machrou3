<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\AssocProjectsCriterionsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\AssocProjectsCriterionsTable Test Case
 */
class AssocProjectsCriterionsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\AssocProjectsCriterionsTable
     */
    public $AssocProjectsCriterions;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.assoc_projects_criterions',
        'app.projects',
        'app.teams',
        'app.departements',
        'app.assoc_projects_teams',
        'app.users',
        'app.assoc_teams_users',
        'app.actiondisciplinaires',
        'app.assoc_users_actiondisciplinaires',
        'app.assoc_users_projects',
        'app.rapports',
        'app.clients',
        'app.assoc_clients_projects',
        'app.priorities',
        'app.project_stages',
        'app.criterions'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('AssocProjectsCriterions') ? [] : ['className' => 'App\Model\Table\AssocProjectsCriterionsTable'];
        $this->AssocProjectsCriterions = TableRegistry::get('AssocProjectsCriterions', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->AssocProjectsCriterions);

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
