<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CriterionsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CriterionsTable Test Case
 */
class CriterionsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\CriterionsTable
     */
    public $Criterions;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.criterions',
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
        $config = TableRegistry::exists('Criterions') ? [] : ['className' => 'App\Model\Table\CriterionsTable'];
        $this->Criterions = TableRegistry::get('Criterions', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Criterions);

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
