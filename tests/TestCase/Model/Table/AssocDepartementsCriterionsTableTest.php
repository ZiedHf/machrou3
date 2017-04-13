<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\AssocDepartementsCriterionsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\AssocDepartementsCriterionsTable Test Case
 */
class AssocDepartementsCriterionsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\AssocDepartementsCriterionsTable
     */
    public $AssocDepartementsCriterions;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.assoc_departements_criterions',
        'app.departements',
        'app.teams',
        'app.projects',
        'app.assoc_projects_teams',
        'app.users',
        'app.assoc_teams_users',
        'app.actiondisciplinaires',
        'app.assoc_users_actiondisciplinaires',
        'app.assoc_users_projects',
        'app.rapports',
        'app.criterions',
        'app.assoc_projects_criterions',
        'app.assoc_users_criterions',
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
        $config = TableRegistry::exists('AssocDepartementsCriterions') ? [] : ['className' => 'App\Model\Table\AssocDepartementsCriterionsTable'];
        $this->AssocDepartementsCriterions = TableRegistry::get('AssocDepartementsCriterions', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->AssocDepartementsCriterions);

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
