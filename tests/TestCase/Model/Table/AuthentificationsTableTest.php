<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\AuthentificationsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\AuthentificationsTable Test Case
 */
class AuthentificationsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\AuthentificationsTable
     */
    public $Authentifications;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.authentifications'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Authentifications') ? [] : ['className' => 'App\Model\Table\AuthentificationsTable'];
        $this->Authentifications = TableRegistry::get('Authentifications', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Authentifications);

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
