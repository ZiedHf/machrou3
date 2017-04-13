<?php
namespace App\Test\TestCase\Controller;

use App\Controller\AssocUsersCriterionsController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\AssocUsersCriterionsController Test Case
 */
class AssocUsersCriterionsControllerTest extends IntegrationTestCase
{

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
     * Test index method
     *
     * @return void
     */
    public function testIndex()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test view method
     *
     * @return void
     */
    public function testView()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test add method
     *
     * @return void
     */
    public function testAdd()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test edit method
     *
     * @return void
     */
    public function testEdit()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test delete method
     *
     * @return void
     */
    public function testDelete()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
