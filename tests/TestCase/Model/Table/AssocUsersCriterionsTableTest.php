<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\AssocUsersCriterionsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\AssocUsersCriterionsTable Test Case
 */
class AssocUsersCriterionsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\AssocUsersCriterionsTable
     */
    public $AssocUsersCriterions;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.assoc_users_criterions',
        'app.users',
        'app.teams',
        'app.departements',
        'app.projects',
        'app.assoc_projects_teams',
        'app.assoc_users_projects',
        'app.clients',
        'app.assoc_clients_projects',
        'app.criterions',
        'app.assoc_projects_criterions',
        'app.priorities',
        'app.project_stages',
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
        $config = TableRegistry::exists('AssocUsersCriterions') ? [] : ['className' => 'App\Model\Table\AssocUsersCriterionsTable'];
        $this->AssocUsersCriterions = TableRegistry::get('AssocUsersCriterions', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->AssocUsersCriterions);

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
