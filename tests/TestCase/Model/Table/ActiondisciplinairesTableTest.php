<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ActiondisciplinairesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ActiondisciplinairesTable Test Case
 */
class ActiondisciplinairesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ActiondisciplinairesTable
     */
    public $Actiondisciplinaires;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.actiondisciplinaires'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Actiondisciplinaires') ? [] : ['className' => 'App\Model\Table\ActiondisciplinairesTable'];
        $this->Actiondisciplinaires = TableRegistry::get('Actiondisciplinaires', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Actiondisciplinaires);

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
