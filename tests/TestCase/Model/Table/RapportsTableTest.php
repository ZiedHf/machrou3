<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\RapportsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\RapportsTable Test Case
 */
class RapportsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\RapportsTable
     */
    public $Rapports;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.rapports',
        'app.users',
        'app.assoc_teams_users',
        'app.assoc_users_actiondisciplinaires',
        'app.assoc_users_projects'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Rapports') ? [] : ['className' => 'App\Model\Table\RapportsTable'];
        $this->Rapports = TableRegistry::get('Rapports', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Rapports);

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
