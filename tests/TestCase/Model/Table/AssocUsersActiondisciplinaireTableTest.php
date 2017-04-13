<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\AssocUsersActiondisciplinairesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\AssocUsersActiondisciplinairesTable Test Case
 */
class AssocUsersActiondisciplinairesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\AssocUsersActiondisciplinairesTable
     */
    public $AssocUsersActiondisciplinaires;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.assoc_users_actiondisciplinaires',
        'app.actiondisciplinaires',
        'app.users',
        'app.assoc_teams_users',
        'app.teams',
        'app.departements',
        'app.assoc_projects_teams',
        'app.projects',
        'app.assoc_users_projects',
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
        $config = TableRegistry::exists('AssocUsersActiondisciplinaires') ? [] : ['className' => 'App\Model\Table\AssocUsersActiondisciplinairesTable'];
        $this->AssocUsersActiondisciplinaires = TableRegistry::get('AssocUsersActiondisciplinaires', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->AssocUsersActiondisciplinaires);

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
