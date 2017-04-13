<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PrioritiesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PrioritiesTable Test Case
 */
class PrioritiesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\PrioritiesTable
     */
    public $Priorities;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.priorities',
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
        'app.assoc_clients_projects'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Priorities') ? [] : ['className' => 'App\Model\Table\PrioritiesTable'];
        $this->Priorities = TableRegistry::get('Priorities', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Priorities);

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
}
